<?php
include 'db.php';

if (isset($_GET['resid']) && isset($_GET['nbb'])) {
    $nb = $_GET['nbb'];
    $acceptID = $_GET['resid'];
    $caseid= $_GET['caseid'];

    // If case is "Won"
    if ($acceptID == 1) {
        // Get the cvid passed through the URL
        if (isset($_GET['cvid'])) {
            $cvid = $_GET['cvid'];

            // Update the case status to 'Won'
            $sql1 = "UPDATE `case` SET casestatus='Closed', enddate=NOW() WHERE userid='$nb' AND id='$caseid'";

            // Insert into the casewon table
            $sql2 = "INSERT INTO `casewon` (nbofcases, year, cvid)
                     VALUES (1, YEAR(CURDATE()), '$cvid')";

            // Execute the update query
            if ($conn->query($sql1) === TRUE) {
                // If the case status is updated successfully, execute the insert query for casewon
                if ($conn->query($sql2) !== TRUE) {
                    echo "Error inserting record into casewon: " . $conn->error;
                }
                header("Location: accepted.php"); 
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } 
} else {
    echo "Invalid request.";
}
?>
