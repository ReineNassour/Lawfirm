<?php
session_start();
include 'db.php';

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caseid   = $_POST['caseid'];
    $userid   = $_POST['userid'];
    $x        = $_POST['x'];
    $y        = $_POST['y'];
    $city     = $conn->real_escape_string(trim($_POST['city']));
    $street   = $conn->real_escape_string(trim($_POST['street']));
    $building = $conn->real_escape_string(trim($_POST['building']));
    $Adetails = $conn->real_escape_string(trim($_POST['Adetails']));
    $Sdetails = $conn->real_escape_string(trim($_POST['Sdetails']));
    $date     = $conn->real_escape_string(trim($_POST['date']));
    $time     = $conn->real_escape_string(trim($_POST['time']));
    $judge    = $conn->real_escape_string(trim($_POST['judge']));

    // Check 1: Conflict with Zoom meeting
    $clashMeetingSQL = "SELECT * FROM meetings WHERE date = '$date' AND time = '$time'  ";
    $clashMeetingRes = $conn->query($clashMeetingSQL);
    if ($clashMeetingRes && $clashMeetingRes->num_rows > 0) {
        header("Location: location.php?error=" .
               urlencode("You can't set a session on $date at $time because a Zoom meeting already exists.") .
               "&pid=$caseid&userid=$userid");
        exit();
    }

    // Check 2: Conflict with another session
    $clashSessionSQL = "SELECT * FROM session WHERE date = '$date' AND time = '$time' ";
    $clashSessionRes = $conn->query($clashSessionSQL);
    if ($clashSessionRes && $clashSessionRes->num_rows > 0) {
        header("Location: location.php?error=" .
               urlencode("You can't set a session on $date at $time because another session already exists.") .
               "&pid=$caseid&userid=$userid");
        exit();
    }

    // No clashes → begin transaction
    $conn->begin_transaction();

    try {
        // Insert address
        $addrSQL = "INSERT INTO address (x, y, details, city, building, street, caseid)
                    VALUES ('$x', '$y', '$Adetails', '$city', '$building', '$street', '$caseid')";
        if (!$conn->query($addrSQL)) {
            throw new Exception("Address insert failed");
        }
        $addressid = $conn->insert_id;

        // Insert session
        $sessSQL = "INSERT INTO session (date, time, details, caseid, addressid)
                    VALUES ('$date', '$time', '$Sdetails', '$caseid', '$addressid')";
        if (!$conn->query($sessSQL)) {
            throw new Exception("Session insert failed");
        }

        // Insert judge
        $judgeSQL = "INSERT INTO judge (name, caseid)
                     VALUES ('$judge', '$caseid')";
        if (!$conn->query($judgeSQL)) {
            throw new Exception("Judge insert failed");
        }

        // Commit all
        $conn->commit();
        header("Location: location.php?pid=$caseid&userid=$userid");
        exit();

    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
