<?php
session_start();
include 'db.php';
$att = $_SESSION['attorney']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $userid = $_POST['userid'];
    $caseid = $_POST['caseid'];

    // Match the URL in the message
    preg_match('/(https?:\/\/[^\s]+)/', $message, $match);
    $link = isset($match[1]) ? $match[1] : '';

    // Match date and time (without the "your session is scheduled:" part)
    preg_match('/date:\s*(\d{2}-\d{2}-\d{4})\s*time:\s*(\d{2}:\d{2})/', $message, $matches);

    $date = isset($matches[1]) ? $matches[1] : '';
    $time = isset($matches[2]) ? $matches[2] : '';

    // If a link, date, and time are found, insert into the meetings table
    if (!empty($link) && !empty($date) && !empty($time)) {
        $sqlMeeting = "INSERT INTO meetings (link, status, date, time, caseid)
                       VALUES ('$link', 'Pending', '$date', '$time', '$caseid')";
        $conn->query($sqlMeeting);
    } 
     
    else {
        $sqlChat = "INSERT INTO chats (usermss, attmss, time, userid, attid,caseid) 
                    VALUES ('', '$message', NOW(), '$userid', '$att', '$caseid')";
        $conn->query($sqlChat);
    }

    header("Location: accepted.php");
    exit();
}
?>
