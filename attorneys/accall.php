<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
 
    
    $sql1="UPDATE `case` SET `status`='Accepted' where `status`='Pending'";
    $conn->query($sql1);

    header("Location:accepted.php");

}


?>