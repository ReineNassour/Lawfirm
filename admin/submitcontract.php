<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salary = htmlspecialchars($_POST["salary"]);
    $start_date = htmlspecialchars($_POST["start_date"]);
    $expiry_date = htmlspecialchars($_POST["expiry_date"]);
    $nb_of_hour = htmlspecialchars($_POST["nb_of_hour"]);
    $details = htmlspecialchars($_POST["details"]);
    $attid = htmlspecialchars($_POST["attid"]);

    $sql = "INSERT INTO `attcontract`(`salary`, `startdate`, `expirydate`, `details` ,`nbofHour`, `attid`)
     VALUES ('$salary','$start_date','$expiry_date', '$details' ,'$nb_of_hour','$attid')";
    $result = $conn->query($sql);


    header("Location: passedlawyers.php");
}
?>
