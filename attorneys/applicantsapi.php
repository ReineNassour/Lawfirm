<?php
// Include your database connection file
include 'db.php';

// Set the header to return JSON data
header('Content-Type: application/json');

// SQL query to select applications with status = 'Accepted'
$sql = "SELECT userid, COUNT(*) AS accepted_count FROM `application` WHERE status = 'Accepted' GROUP BY userid";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $data = [];

    // Fetch each row and prepare the data for charting
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'userid' => $row['userid'],
            'accepted_count' => $row['accepted_count']
        ];
    }

    // Output the data in JSON format
    echo json_encode($data);
} else {
    // If no records found, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
