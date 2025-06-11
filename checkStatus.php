<?php
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['status'] == "Unverified") {
        header("Location: verification.php");
    }
}
