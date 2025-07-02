<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $sessionid = $_POST['sessionid'];
    $caseid = $_POST['caseid'];

    $sql = "INSERT INTO history (content, sessionid) VALUES ('$details', '$sessionid')";
    $conn->query($sql);

    header("Location: history.php?id=" . urlencode($caseid));
    exit();
}
?>
