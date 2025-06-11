<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    
    $caseid=$_POST['caseid'];
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $comment = htmlspecialchars($_POST['comment']);

    $sql = "INSERT INTO rate (rate, comment , caseid) VALUES ('$rating', '$comment','$caseid')";
  
    if ($conn->query($sql) === TRUE) {
        $success_message = "Thank you for your Rating!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location:attorneys.php?id=". urlencode($caseid));
    exit; 
}

?>