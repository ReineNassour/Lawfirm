<?php
include 'db.php';

// Query to get the number of accepted cases
$sql = "SELECT COUNT(*) as count FROM `case` WHERE status = 'Accepted'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $data = ['count' => $row['count']]; // Return count in JSON format
    echo json_encode($data);
} else {
    echo json_encode(['count' => 0]); // If there is an error, return 0
}

$conn->close();
?>
