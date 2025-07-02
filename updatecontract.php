<?php
include 'db.php';

    if (isset($_POST['enter']) && isset($_FILES["uploadfile"])) {

        $caseid = $_POST['caseid'];

        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./img/" . $filename;

        $sql1 = "UPDATE `case` SET caseContractimg='$folder' WHERE id='$caseid'";

        if (!mysqli_query($conn, $sql1)) {
            echo "Error: " . $conn->error;
        }

        // Move the uploaded image to the folder
        if (move_uploaded_file($tempname, $folder)) {
            header("Location: track.php");
            exit();
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }
    }
   


