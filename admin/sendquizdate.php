<?php
include '../db.php';

$date = $_POST['quiz_date'];
$starttime = $_POST['quiz_time'];
$endtime = $_POST['endtime'];

$sql="INSERT INTO quiz (status,date, starttime,endtime) VALUES ('Pending','$date', '$starttime', '$endtime')";
$conn->query($sql);

header("Location: accepted.php");
exit();
?>
