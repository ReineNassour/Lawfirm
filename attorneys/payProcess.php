<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $desc      = $conn->real_escape_string($_POST['desc']);
    $nbrofpay  = $_POST['nbrofpay'];
    $tot       = $_POST['total'];
    $id= $_POST['caseid'];

    $conn->query("INSERT INTO ccontract (description,total,nbrofpay,status,paycontractimg,caseid)
                  VALUES ('$desc','$tot','$nbrofpay','Pending',0,'$id')");
    header("Location: contract.php?id=$id");
    exit;
}
?>