<?php
session_start();

include 'db.php'; 

header('Content-Type: application/json');

// Check if database connection exists
if (!$conn) {
    echo json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]);
    exit;
}

// Check if user is an authenticated manager
if (!isset($_SESSION['manager'])) {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

// Query to check pending cases
$query = "SELECT COUNT(*) AS count FROM `case` WHERE `status` = 'Pending'";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

$row = $result->fetch_assoc();
$new_booking = ($row['count'] > 0);

echo json_encode(["new_booking" => $new_booking]);

$conn->close();
?>
