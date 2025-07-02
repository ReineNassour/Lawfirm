<?php

include 'db.php';

if (isset($_GET['acceptid']) && isset($_GET['nbb'])) {
    $nb = $_GET['nbb'];
    $acceptID = $_GET['acceptid'];

    if ($acceptID == 1)

        $sql2 = "UPDATE ccontract SET status='Accepted' WHERE caseid='$nb'";

    if ($conn->query($sql2)) {
        header("Location: indexManager.php");
    }
}
?>