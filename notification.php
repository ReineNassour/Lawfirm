<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['manager']) || $_SESSION['manager'] !== true) {
    echo json_encode(["new_booking" => false]);
    exit;
}

$result = $conn->query("SELECT COUNT(*) AS count FROM `case` WHERE status = 'Pending'");

if ($result) {
    $row = $result->fetch_assoc();
    $new_booking = ($row['count'] > 0); // Returns true if new pending cases exist
    echo json_encode(["new_booking" => $new_booking]);
} else {
    echo json_encode(["new_booking" => false]);
}

$conn->close();
?>
