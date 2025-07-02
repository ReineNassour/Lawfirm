<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quizid = $_POST['quizid'];
    $questions = $_POST['question'];
    $grades = $_POST['answer'];

    // Ensure both arrays are same length
    if (count($questions) == count($grades)) {
        foreach ($questions as $key => $question) {
            $grade = $grades[$key];

            $question = $conn->real_escape_string($question);
            $grade = $conn->real_escape_string($grade);

            $sql = "INSERT INTO question (given, grade, quizid)
                    VALUES ('$question', '$grade', '$quizid')";
            $conn->query($sql);
        }

        header("Location: applicants.php");
        exit;
    } else {
        echo "Error: Question and Grade fields mismatch.";
    }
}
?>
