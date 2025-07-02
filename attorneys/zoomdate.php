<?php
include 'db.php';
$caseid = $_POST['caseid'];
$date   = $_POST['date'];   
$stime  = $_POST['stime'];  
$etime  = $_POST['etime'];  
$link   = $_POST['link'];
$status = 'Pending';


$sql = "SELECT time, endtime 
        FROM meetings 
        WHERE date = '$date'";
$res = mysqli_query($conn, $sql);

$buffer = 30 * 60;                
$newStart = strtotime($stime);
$newEnd   = strtotime($etime);
$conflict = false;

while ($row = mysqli_fetch_assoc($res)) {
    $oldStart = strtotime($row['time']);
    $oldEnd   = strtotime($row['endtime']);

    if ($newStart < $oldEnd && $newEnd > $oldStart) {
        $conflict = true;
        break;
    }

    if ($newStart >= $oldStart - $buffer && $newStart < $oldStart) {
        $conflict = true;
        break;
    }
}

if ($conflict) {
    header("Location: accepted.php?error=" . urlencode("Time clash — leave 30 minutes before or after any existing meeting."));
    exit();
}


$sessionSQL = "SELECT * FROM session WHERE date = '$date' AND time = '$stime' ";
$sessionRes = mysqli_query($conn, $sessionSQL);

if ($sessionRes && mysqli_num_rows($sessionRes) > 0) {
    header("Location: accepted.php?error=" . urlencode("You cannot schedule a meeting at this time — a court session already exists."));
    exit();
}

$insert = "INSERT INTO meetings (link, status, date, time, endtime, caseid)
           VALUES ('$link', '$status', '$date', '$stime', '$etime', '$caseid')";

if (mysqli_query($conn, $insert)) {
    header("Location: accepted.php");
    exit();
} else {
    echo "Error scheduling meeting.";
}

mysqli_close($conn);
?>
