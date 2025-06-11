<?php
 session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $recaptcha_secret = "6Lco0vwqAAAAAEDehbRS_mEZkWrDDKCC5q2z-kCu"; 
$recaptcha_response = $_POST['g-recaptcha-response'];

$recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
$recaptcha_data = [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($recaptcha_data)
    ]
];

$context = stream_context_create($options);
$recaptcha_result = file_get_contents($recaptcha_url, false, $context);
$recaptcha_json = json_decode($recaptcha_result);

if (!$recaptcha_json->success) {
   header("Location: signup.php");
 exit();
 }
//recaptcha end
   
    if (isset($_POST['fn'], $_POST['ln'], $_POST['email'], $_POST['pass'])) {
        include 'db.php';

        $email = $_POST['email'];
        $password = $_POST['pass'];
        $lname = $_POST['ln'];
        $fname = $_POST['fn'];
        $phone = $_POST['phone'];
        $address = $_POST['add'];

        if (empty($fname)) {
            $_SESSION['signupErr']['fn'] = "Enter a first name";
        }
        if (empty($lname)) {
            $_SESSION['signupErr']['ln'] = "Enter a last name";
        }
        if (validateEmail($email, $conn) !== true) {
            $_SESSION['signupErr']['email'] = validateEmail($email, $conn);
        }
        if (validatePassword($password) !== true) {
            $_SESSION['signupErr']['pass'] = validatePassword($password);
        }
        if (empty($phone)) {
            $_SESSION['signupErr']['phone'] = "Enter Your Phone Number";
        }
        if (empty($address)) {
            $_SESSION['signupErr']['add'] = "Enter Your Address";
        }

        if ($_POST['pass'] !== $_POST['confirm_pass']) {
            $_SESSION['signupErr']['confirm_pass'] = "Passwords do not match.hjjjjjj";
            header("Location: signup.php");
            exit();
        }

        if (isset($_SESSION['signupErr'])) {
            header("Location: signup.php");
        } else {
            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user VALUES(NULL, '$fname', '$lname', '$email', '$hashedPassword', '$address', '$phone',0, 0,'Unverified')";
            $conn->query($sql);
            $sql2 = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
            $id = $conn->query($sql2)->fetch_assoc()['id'];
            $_SESSION['user'] = [
                'id' => $id,
                "fullName" => $fname . ' ' . $lname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'status' => 'Unverified'
            ];
            header("Location: index.php");
        }
    }
}

function validateEmail($email, $conn)
{
    $parts = explode('@', $email);
    if (count($parts) != 2 || $parts[1] !== 'gmail.com') {
        return "Invalid email format.";
    }
    $result = $conn->query("SELECT id FROM user WHERE email = '$email'");
    if ($result->num_rows > 0) {
        return "Email already exists.";
    }

    return true;
}

// Function to validate password
function validatePassword($password)
{
    $hasDigit = false;
    $hasUpper = false;
    $hasSpecial = false;
    $specialChars = ['$', '@', '!', '#'];

    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];
        if (ctype_digit($char)) {
            $hasDigit = true;
        } elseif (ctype_upper($char)) {
            $hasUpper = true;
        } elseif (in_array($char, $specialChars)) {
            $hasSpecial = true;
        }
    }

    if (!$hasDigit) {
        return "Password must contain at least one digit.";
    }
    if (!$hasUpper) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!$hasSpecial) {
        return "Password must contain at least one special character ($, @, !, or #).";
    }

    return true;
}

?>