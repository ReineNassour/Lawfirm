<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $message=$_POST['message'];
    $userid=$_POST['userid'];

    $sql="INSERT INTO inquiry (content,date,status,userid) VALUES ('$message',NOW(),'Pending','$userid')";
$conn->query($sql);
header("Location:contact.php");
}

?>