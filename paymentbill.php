<?php

session_start();
include 'checkStatus.php';
include 'header.php';
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Template Stylesheet -->
<link href="./css/style.css" rel="stylesheet">
    <link href="./css/payment.css" rel="stylesheet">
    <link href="./css/apply.css" rel="stylesheet">
    
    <style>
    .page-header {
    height: 200px;
    display: flex;
    align-items: center; 
    justify-content: center;
    padding: 20px 0;
}

#canvas {
  border: 2px solid #000;
  background-color: #fff;
  touch-action: none; /* Prevent scrolling on touch devices while drawing */
}

#signature-pad {
  text-align: center;
  margin-top: 20px;
}

</style>

</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    
<?php

$id = $_GET['id'];

$sql1 = "SELECT * FROM `ccontract` WHERE caseid='$id'";
$res1 = $conn->query($sql1);
if ($res1->num_rows == 0) {
    ?>
     <div class="row">
                        <div class="col-12">
                            <div class="application-message">
                                <i class="fas fa-hourglass-half"></i>
                                <h1>This Case Has No Case Contract And Payment Contract Yet To See The Payment Bill, Please Wait.</h1>
                                <p class="mb-4">You have already submitted a Case and Your Attorney is currently Preparing The Bill. Please be patient as we process It.</p>
                                <a href="track.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
    <br><br><br>
    <?php
     include 'footer.php';
    exit;
   
} else {
$row1 = $res1->fetch_assoc();
$caseid=$row1['caseid'];
$contractid=$row1['id'];
$img=$row1['paycontractimg'];

$sql3 = "SELECT * FROM `case` WHERE id='$caseid'";
$res3 = $conn->query($sql3);
$row3 = $res3->fetch_assoc();
$userid=$row3['userid'];
$catid=$row3['categoryid'];

$sql5 = "SELECT * FROM `category` WHERE id='$catid'";
$res5 = $conn->query($sql5);
$row5= $res5->fetch_assoc();
$catname=$row5['name'];

$sql4 = "SELECT * FROM `user` WHERE id='$userid'";
$res4 = $conn->query($sql4);
$row4 = $res4->fetch_assoc();
$email=$row4['email'];
$fname=$row4['fname'];
$lname=$row4['lname'];
?>

<?php
$sql9="SELECT * FROM `payments` WHERE ccontractid='$contractid' ";
$res9 = $conn->query($sql9);
if($res9->num_rows == 0){
?>
                     <div class="row">
                        <div class="col-12">
                            <div class="application-message">
                                <i class="fas fa-hourglass-half"></i>
                                <h1>Upon Signing Your Payment Contract, You Will Receive a Complete Overview of All Your Payments</h1>
                            </div>
                        </div>
                    </div><br>

<?php
} else {

if($img == 0){
?>

 <div class="row">
                        <div class="col-12">
                            <div class="application-message">
                                <i class="fas fa-hourglass-half"></i>
                                <h1>Please Go To <strong><a href="payment.php?id=<?= $caseid ; ?>">Payment Contract</a></strong>, And Sign your Contract.</h1>
                            </div>
                        </div>
                    </div><br>

<?php
} else {


?>
<div class="container payment-container">
    <?php include 'db.php'; ?>
    <form method="post">
        <div id="paymentWrapper">
            <div class="payment-card">
                <div style="text-align: center;">
                    <h2 class="payment-header"><b> Payment Bill Details</b></h2></div>
                <table class="payment-table">
                    <thead>
                        <tr>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row9 = $res9->fetch_assoc()) {
                            $status = $row9['status'];
                            $payid = $row9['id'];
                            $payment = $row9['amount'];
                        ?>
                        <tr>
                            <td><?= $payment . ' $'; ?></td>
                            <td><?= $row9['date']; ?></td>
                            <td>
                                <?= ($status == "UnPaid") ? "UnPaid" : "Paid"; ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<?php
}
}
}
?>



<div class="text-center mb-4">
    
    <a href="track.php?id=<?= $caseid ; ?>" class="btn btn-black btn-action">
        <i class="fas fa-file-contract mr-1"></i> Back
    </a>
</div>

 
</body>

</html>