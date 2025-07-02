<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $grades = $_POST['grade'];
    $questids = $_POST['questid'];

    for ($i = 0; $i < count($grades); $i++) {
        $grade = mysqli_real_escape_string($conn, $grades[$i]);
        $questid = mysqli_real_escape_string($conn, $questids[$i]);

        // Update the grade based on userid and questid
        $sql = "UPDATE answers SET grade='$grade' WHERE userid='$userid' AND questid='$questid'";
        mysqli_query($conn, $sql) or die("Error updating grade: " . mysqli_error($conn));
    }

    header("Location: quizanswers.php?id=" . $userid);
    exit();
}
?>
