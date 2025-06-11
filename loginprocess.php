<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "db.php";

    function validateEmail($email, $conn) {
        $result = $conn->query("SELECT id FROM user WHERE email = '$email'");
        if ($result->num_rows == 0) {
            return "Invalid email or password.";
        } else {
            return true;
        }
    }

    function validatePassword($email, $conn, $password) {
        $result = $conn->query("SELECT password FROM user WHERE email = '$email'");
        $user = $result->fetch_assoc();
        if ($user) {
            $dbPassword = $user['password'];
            if (!password_verify($password, $dbPassword)) {
                return "Invalid email or password.";
            } else {
                return true;
            }
        } else {
            return "Invalid email or password.";
        }
    }

    function getName($email, $conn) {
        $result = $conn->query("SELECT fname, lname FROM user WHERE email = '$email'");
        $user = $result->fetch_assoc();
        return $user['fname'] . ' ' . $user['lname'];
    }

    function getStatus($email, $conn) {
        $result = $conn->query("SELECT status FROM user WHERE email = '$email'");
        $user = $result->fetch_assoc();
        return $user['status'];
    }


    function getID($email, $conn) {
        $result = $conn->query("SELECT id FROM user WHERE email = '$email'");
        $user = $result->fetch_assoc();
        return $user['id'];
    }

    if (isset($_POST['email'], $_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $emailValidated = validateEmail($email, $conn);

        session_start();

        $sql1 = "SELECT role FROM user WHERE email = '$email'";
        $res1 = $conn->query($sql1);

        if ($res1->num_rows > 0) {
            $row1 = $res1->fetch_assoc();
            $role = $row1['role'];

            if ($emailValidated === true) {
                $passwordValidated = validatePassword($email, $conn, $pass);

                if ($passwordValidated === true) {
                    if ($role === '0') {
                        $_SESSION['user'] = [
                            'id' => getID($email, $conn),
                            'fullName' => getName($email, $conn),
                            'email' => $email,
                            'status' => getStatus($email,$conn),
                        ];
                        header("Location: index.php");
                        exit();
                    } else if ($role === '1') {
                        $_SESSION['admin'] = [
                            'id' => getID($email, $conn),
                            'fullName' => getName($email, $conn),
                            'email' => $email,
                        ];
                        header("Location: admin/dashboard.php");
                        exit();
                    }
                    else if ($role === '2') {
                        $_SESSION['attorney'] = [
                            'id' => getID($email, $conn),
                            'fullName' => getName($email, $conn),
                            'email' => $email,
                        ];
                        header("Location: attorneys/index.php");
                        exit();
                    }

                    else if ($role === '3') {
                        $_SESSION['manager'] = [
                            'id' => getID($email, $conn),
                            'fullName' => getName($email, $conn),
                            'email' => $email,
                        ];
                        header("Location: attorneys/indexManager.php");
                        
                    }

                    else if ($role === '4') {
                        $_SESSION['cashier'] = [
                            'id' => getID($email, $conn),
                            'fullName' => getName($email, $conn),
                            'email' => $email,
                        ];
                        header("Location: attorneys/cashierindex.php");
                        
                    }
                    
                } else {
                    $_SESSION['loginErr'] = $passwordValidated;
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['loginErr'] = $emailValidated;
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['loginErr'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
        session_write_close();
    }
 } else {
    header("Location: login.php");
 exit();
}
?>