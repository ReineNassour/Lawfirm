<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $userid = $_POST['userid'];

    preg_match('/(https?:\/\/[^\s]+)/', $message, $match);
    $link = isset($match[1]) ? $match[1] : '';

    preg_match('/date:\s*(\d{2}-\d{2}-\d{4})\s*time:\s*(\d{2}:\d{2})/', $message, $matches);

    $date = isset($matches[1]) ? $matches[1] : '';
    $time = isset($matches[2]) ? $matches[2] : '';

    if (!empty($link) && !empty($date) && !empty($time)) {
        $sqlMeeting = "INSERT INTO `application` (interviewlink, interviewStatus, interviewdate, interviewtime,userid)
                       VALUES ('$link', 'Pending', '$date', '$time','$userid')";
        $conn->query($sqlMeeting);
    } 

    header("Location: accepted.php");
    exit();
}
?>
