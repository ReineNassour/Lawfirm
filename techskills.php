<?php
session_start();
include 'checkStatus.php';
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['languageName']) && isset($_POST['languageLevel'])) {
        $numOfLanguages = count($_POST['languageName']);
        for ($i = 0; $i < $numOfLanguages; $i++) {
            // Check if the language level and name are available
            if (isset($_POST['languageName'][$i]) && isset($_POST['languageLevel'][$i])) {
                $languageName = mysqli_real_escape_string($conn, $_POST['languageName'][$i]);
                $languageLevel = mysqli_real_escape_string($conn, $_POST['languageLevel'][$i]);

                $sql1 = "SELECT * FROM cv ORDER BY id DESC LIMIT 1";
                $res1 = $conn->query($sql1);
                $row1 = $res1->fetch_assoc();
                $cvid = $row1['id'];

                $sql = "INSERT INTO `language` (language, level, cvid) 
                VALUES ('$languageName', '$languageLevel', '$cvid')";

                if (!$conn->query($sql)) {
                    echo "Error: " . $conn->error;
                }
            }
        }
    }

    if (isset($_POST['tech']) && isset($_POST['textarea'])) {
        $level = mysqli_real_escape_string($conn, $_POST['tech']);
        $desc = mysqli_real_escape_string($conn, $_POST['textarea']);

        $sql2 = "INSERT INTO techskills (description, `p/e/w`,cvid) VALUES ('$desc', '$level','$cvid')";
        if (!$conn->query($sql2)) {
            echo "Error: " . $conn->error;
        }
    }

    // Handling file upload
    if (isset($_POST['enter']) && isset($_FILES["uploadfile"])) {
        $id = $_SESSION['user']['id'];

        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./img/" . $filename;

        $sql1 = "UPDATE `user` SET image='$folder' WHERE id='$id'";

        if (!mysqli_query($conn, $sql1)) {
            echo "Error: " . $conn->error;
        }

        // Move the uploaded image to the folder
        if (move_uploaded_file($tempname, $folder)) {
            header("Location: doneapplying.php");
            exit();
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Kanun - Law Firm Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Website Template" name="keywords">
    <meta content="Law Firm Website Template" name="description">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .language-entry {
            margin-bottom: 15px;
        }
        .language-entry input {
            margin-right: 10px;
        }

        .radio-buttons {
    display: flex;
    
}

.radio-buttons input {
    margin-right: 10px; /* Adds some space between radio buttons and labels */
}

.radio-buttons label {
    margin-right: 20px; /* Adds space between the labels */
}

    </style>
</head>

<body>
<div class="wrapper">
    <!-- Top Bar Start -->
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="index.html">
                            <h1>TheFirm</h1>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="top-bar-right">
                        <div class="text">
                            <h2>8:00 - 9:00</h2>
                            <p>Opening Hour Mon - Fri</p>
                        </div>
                        <div class="text">
                            <h2>+123 456 7890</h2>
                            <p>Call Us For More Informations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Bar End -->

    <!-- Nav Bar Start -->
    <div class="nav-bar">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <a href="#" class="navbar-brand">MENU</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="ml-auto">
                        <a class="btn" href="index.php">Home</a>
                    </div>

                    <?php
                        if (isset($_SESSION['user'])) {
                            ?>
                             <div class="ml-auto">
                                <a class="btn" href="logout.php">Logout</a>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <h2 style="color:white;">  Welcome , <?php echo $_SESSION['user']['fullName'] ; ?></h2>
                        <div class="dropdown-menu border-0 rounded-0 m-0">
                       
                        </div>
                    <?php } ?>
                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->

    <!-- Language Skills Form Start -->
    <div class="container mt-5">
        <h2 style="text-decoration:underline;">About Your Language And Technical Skills :</h2><br>
    
        <form id="languageForm" method="POST" action=""  enctype="multipart/form-data">
            <div id="languageContainer">
                <!-- Dynamically added language fields will appear here -->
            </div>

            <button type="button" id="addLanguageBtn" class="btn btn-primary">Add Another Language</button>
            <br><br>

            <div class="form-group">
    <label for="email"><h2>What is your level of proficiency in PowerPoint, Excel, and Word?</h2></label><br>
    
    <div class="radio-buttons">
        <input type="radio" id="beginnerPowerPoint" name="tech" value="beginner">
        <label for="beginnerPowerPoint">Beginner</label>

        <input type="radio" id="intermediatePowerPoint" name="tech" value="intermediate">
        <label for="intermediatePowerPoint">Intermediate</label>

        <input type="radio" id="excellentPowerPoint" name="tech" value="excellent">
        <label for="excellentPowerPoint">Excellent</label>
    </div>
</div>

<label for="fullName"><h2>Do you know any other software or tools besides PowerPoint, Excel, and Word?</h2></label>
            <div class="input-box">
    <textarea id="textarea" name="textarea" placeholder="Describe here..." rows="3" cols="40" style="display: inline-block;"></textarea>
    <div class="word-count" style="color:black; display: inline-block; margin-left: 10px;">
        <span id="current-word-count">0</span> / 50 words
    </div><br><br>

    <label for="fullName"><h2>INSERT YOUR PICTURE :</h2></label><br>
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
<br>

            <button type="submit" class="btn btn-primary" name="enter">Submit</button>
        </form>
    </div>
    <!-- Language Skills Form End -->
</div>

<script>

const textarea = document.getElementById('textarea');
    const wordCountDisplay = document.getElementById('current-word-count');
    const maxWords = 50;

    // Function to count words in the textarea
    function countWords(text) {
        return text.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    // Event listener to monitor textarea input
    textarea.addEventListener('input', function() {
        let text = textarea.value;
        let wordCount = countWords(text);

        if (wordCount > maxWords) {
            const trimmedText = text.split(/\s+/).slice(0, maxWords).join(' ');
            textarea.value = trimmedText;
            wordCount = maxWords;
        }

        wordCountDisplay.textContent = wordCount;
    });


    // Function to add a new language entry
    function addLanguageEntry() {
        const languageContainer = document.getElementById('languageContainer');

        const newLanguageDiv = document.createElement('div');
        newLanguageDiv.classList.add('language-entry');

        newLanguageDiv.innerHTML = `
            <label for="languageName">Language Name:</label>
            <input type="text" name="languageName[]" required><br><br>


            <label for="languageLevel">Proficiency Level:</label>&nbsp;&nbsp;&nbsp;&nbsp;
           Beginner <input type="radio" name="languageLevel[]" value="Bad" required> 
          Intermediate <input type="radio" name="languageLevel[]" value="Medium" required> 
          Fluent  <input type="radio" name="languageLevel[]" value="Fluent" required> 
            
            <button type="button" class="removeLanguageBtn btn btn-primary">Remove</button>
            <hr>
        `;

        languageContainer.appendChild(newLanguageDiv);

        // Add event listener to the "Remove" button
        newLanguageDiv.querySelector('.removeLanguageBtn').addEventListener('click', function() {
            languageContainer.removeChild(newLanguageDiv);
        });
    }

    // Add the first language entry when the page loads
    addLanguageEntry();

    // Add a new language entry when the "Add Another Language" button is clicked
    document.getElementById('addLanguageBtn').addEventListener('click', addLanguageEntry);
</script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

</body>
</html>
