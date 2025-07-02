<?php
include 'db.php';

if (isset($_GET['acceptid']) && isset($_GET['nbb'])) {
    $nb = $_GET['nbb'];
    $acceptID = $_GET['acceptid'];

    if ($acceptID == 1) {
        $sql2 = "UPDATE payments 
                 SET status='Paid' 
                 WHERE ccontractid='$nb' AND status='UnPaid' 
                 ORDER BY id ASC 
                 LIMIT 1";

        if ($conn->query($sql2)) {
            header("Location: cashierpayment.php?id=" . urlencode($nb));
            exit;
        }
    }
}

?>