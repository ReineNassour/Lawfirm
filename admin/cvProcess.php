<?php
include 'db.php';
        if (isset($_GET['acceptid']) && isset($_GET['nbb'])) {
            $nb = $_GET['nbb'];
            $acceptID = $_GET['acceptid'];

            if ($acceptID == 0)
                $sql1 = "UPDATE `cv` SET status='Rejected' WHERE id='$nb'";
            else
                $sql1 = "UPDATE `cv` SET status='Accepted' WHERE id='$nb'";

            if ($conn->query($sql1)) {
                header("Location: applicants.php");
            }
        }
        ?>