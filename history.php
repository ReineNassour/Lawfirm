<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Our Attorneys</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Legal Team" name="keywords">
    <meta content="Meet our expert team of attorneys specializing in various legal practices" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Carousel -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/attorneystyle.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <style>
    .page-header {
    height: 300px;
    display: flex;
    align-items: center; 
    justify-content: center;
    background-color: #f5f5f5; 
    padding: 20px 0;
}

</style>

</head>

<body>

<?php
include 'header.php';
?>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Case History</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="history.php">Case History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <?php
$caseid = $_GET['id'];

$sql2 = "SELECT * FROM `session` WHERE caseid='$caseid' ";
$res2 = $conn->query($sql2);
if($res2->num_rows > 0) {
?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="sessionTable">
                    <thead>
                        <tr>
                            <th>Session's number</th>
                            <th>Details</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $t=0;
while ($row2 = $res2->fetch_assoc()) {
    $t++;
    $sessionid=$row2['id'];

$sql3 = "SELECT * FROM `history` WHERE sessionid='$sessionid' ";
$res3 = $conn->query($sql3);
while ($row3 = $res3->fetch_assoc()) {

                        ?>
                       <tr>
                        <td><?= $t ; ?></td>

                        <td><?= $row3['content'] ; ?></td>
                        <td><?= $row2['date'] ; ?></td>
                       </tr>
                    </tbody>
                    <?php
                     }
                    }
                } else {
                    ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="sessionTable">
                    <thead>
                        <tr>
                            <th>Session's number</th>
                            <th>Details</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td></td>

                        <td></td>
                          
                        <td>

                        
                        </td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php

                }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
