<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answers = $_POST['answer'];
    $questids = $_POST['questid'];
    $userid = $_SESSION['user']['id'];

    for ($i = 0; $i < count($answers); $i++) {
        $qid = mysqli_real_escape_string($conn, $questids[$i]);
        $ans = mysqli_real_escape_string($conn, $answers[$i]);

        $sql = "INSERT INTO answers (answer, grade, questid, userid) VALUES ('$ans', 0, '$qid', '$userid')";
        mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
    }

    header("Location: application.php");
    exit();
}

?>
