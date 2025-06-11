<?php
session_start();
include 'checkStatus.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['textarea'], $_POST['attorney_id'], $_POST['cat'])) {
  
    if (!isset($_POST['textarea'])) {
        echo "Missing required fields.";
        exit;
    }

    $id = $_SESSION['user']['id'];
    $attorney = $_POST['attorney_id'];
    $category = $_POST['cat'];

    $sql2 = "SELECT * FROM `case` WHERE userid='$id' AND categoryid='$category'";
    $res = $conn->query($sql2);
    
    if ($res->num_rows > 3) {
        // User already has a case in this category
        $showError = true;
    } else {
        $text = $_POST['textarea'];
        $new_text = ""; // Initialize an empty string to store the modified text
        
        for ($i = 0; $i < strlen($text); $i++) {
            if ($text[$i] == "'") {
                $new_text .= "\'"; // Append the escaped single quote
            } else {
                $new_text .= $text[$i]; // Append the current character
            }
        }
        
        $sql = "INSERT INTO `case` (`description`, `startdate`, `enddate`, `status`,`casestatus`, `caseContractimg` ,`userid`, `categoryid`, `attid`) 
                VALUES ('$new_text', NOW(), 0, 'Pending','Pending', 0 , $id, '$category', '$attorney')";
    
        if ($conn->query($sql) === TRUE) {
            header("Location: donebooking.php");
            exit;
        } else {
            $dbError = $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Case Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Book Case" name="keywords">
    <meta content="Book a consultation with our expert attorneys" name="description">

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

    <!-- Custom Styles -->
    <link href="css/book.css" rel="stylesheet">
</head>

<body>
    <!-- Header included here -->
    <?php include 'header.php'; ?>

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Booking Status</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="cases.php">Case Studies</a>
                    <a href="#">Booking Status</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content Section Start -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (isset($showError) && $showError): ?>
                        <div class="message-card message-error">
                            <div class="message-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h2>Booking Error</h2>
                            <p>You already have Many active cases in this category. You cannot book the same case type More than 4 times.</p>
                            <a href="cases.php" class="btn btn-primary">Back to Cases</a>
                        </div>
                    <?php elseif (isset($dbError)): ?>
                        <div class="message-card message-error">
                            <div class="message-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h2>System Error</h2>
                            <p>We encountered an error while processing your request. Please try again later or contact support.</p>
                            <p class="small text-muted">Error details: <?= $dbError ?></p>
                            <a href="cases.php" class="btn btn-primary">Back to Cases</a>
                        </div>
                    <?php elseif (!isset($_POST['textarea']) || !isset($_POST['attorney_id']) || !isset($_POST['cat'])): ?>
                        <div class="message-card message-error">
                            <div class="message-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h2>Invalid Request</h2>
                            <p>Missing required information for booking. Please try again with complete details.</p>
                            <a href="cases.php" class="btn btn-primary">Back to Cases</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Content Section End -->

    <!-- Footer included here -->
    <?php include 'footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Sticky Header
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.header').addClass('sticky');
            } else {
                $('.header').removeClass('sticky');
            }
        });

        // Back to Top Button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                $('.back-to-top').addClass('active');
            } else {
                $('.back-to-top').removeClass('active');
            }
        });

        $('.back-to-top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    </script>
</body>

</html>