<?php
include 'db.php';

        if (isset($_GET['acceptid']) && isset($_GET['nbb'])) {
            $nb = $_GET['nbb'];
            $acceptID = $_GET['acceptid'];

            if ($acceptID == 0)
                $sql1 = "UPDATE `application` SET interviewstatus='Done' WHERE id='$nb'";
                
            if ($conn->query($sql1)) {
                header("Location: applicants.php");
            }
        }
        ?>