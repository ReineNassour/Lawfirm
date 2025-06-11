<?php
session_start();
include 'db.php';
$id=$_SESSION['user']['id'];
$email=$_SESSION['user']['email'];
$name=$_SESSION['user']['fullName'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $casename = mysqli_real_escape_string($conn, $_POST['casename']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $rating = (int)$_POST['rating'];

    $sql = "INSERT INTO feedback ( date,name,casename,comment, rating,user_id) 
            VALUES ( NOW(),'$name','$casename','$comment',$rating, '$id')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Thank you for your feedback!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }

    header("location:feedback.php");
    exit; 

}

?>