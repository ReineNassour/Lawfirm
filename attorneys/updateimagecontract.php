<?php
include 'db.php';
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['enter'])) {
    $caseid = $_POST['id'];
    
    // Ensure the file was uploaded without errors
    if ($_FILES["uploadfile"]["error"] > 0) {
        echo "Error: " . $_FILES["uploadfile"]["error"];
    } else {
        // Get the file name and temporary file path
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        
        // Sanitize the file name to avoid special characters causing issues
        $sanitized_filename = preg_replace("/[^a-zA-Z0-9\-_\.]/", "_", $filename);
        
        // Ensure the 'img' folder exists, create it if it doesn't
        if (!is_dir('./img/')) {
            mkdir('./img/', 0777, true);
        }
        
        // Set the destination folder and file path
        $folder = "./img/" . $sanitized_filename;

        // Escape the file name to prevent SQL injection and syntax errors
        $escaped_filename = mysqli_real_escape_string($conn, $sanitized_filename);

        // Prepare SQL query (assuming $conn is already defined elsewhere in your code)
        $sql = "UPDATE `ccontract` SET contractimage='$escaped_filename' WHERE caseid='$caseid'";

        // Execute query and check for success
        if (mysqli_query($conn, $sql)) {
            // Move uploaded file to the folder
            if (move_uploaded_file($tempname, $folder)) {
                // Redirect after successful upload and database update
                header("Location: ccontract.php");
                exit;  // Ensure no further code is executed after the redirection
            } else {
                echo "<h3>Failed to upload image! Please check file permissions and path.</h3>";
            }
        } else {
            // If SQL query fails
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>