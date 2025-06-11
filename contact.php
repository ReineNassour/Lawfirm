<?php
session_start();
include 'checkStatus.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Contact Us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Contact" name="keywords">
    <meta content="Contact our legal experts for consultation and inquiries" name="description">

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
   
    <link href="css/contact.css" rel="stylesheet">

</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Contact Us</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="contact.php">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Get In Touch</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="contact-text">
                                <h2>Location</h2>
                                <p>Qubic Square Business, Sin El Fil, Beirut, Lebanon</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa fa-phone-alt"></i>
                            <div class="contact-text">
                                <h2>Phone</h2>
                                <p>+012 345 67890</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa fa-envelope"></i>
                            <div class="contact-text">
                                <h2>Email</h2>
                                <p>thefirm.contact.leb@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa fa-clock"></i>
                            <div class="contact-text">
                                <h2>Office Hours</h2>
                                <p>Monday - Friday: 8:00 AM - 9:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

<?php
if(isset($_SESSION['user']['id'])){
    $userid= $_SESSION['user']['id'];
    $name= $_SESSION['user']['fullName'];
    $email= $_SESSION['user']['email'];
?>

                <div class="col-md-6">
                    <div class="contact-form">
                        <form method="post" action="inquiry.php">
                            <div class="form-group">
    <strong class="form-control-plaintext">
       Should you wish to inquire further, kindly send your message to the Legal Administrative Office.
</strong>
</div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="<?= $name ; ?>" readonly />
                                <input type="hidden" name="userid" value="<?= $userid ; ?>" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="<?= $email ; ?>" readonly />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Message" required="required" rows="5"></textarea>
                            </div>
                            <div>
                                <button class="btn" type="submit">
                                    <i class="fa fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="section-header">
                <h2>Inquiries</h2>
            </div>
            <div class="owl-carousel testimonial-carousel">
   <?php
$sql2 = "SELECT * FROM inquiry WHERE userid='$userid'";
$res2 = $conn->query($sql2);

if ($res2->num_rows > 0) {
    while ($row2 = $res2->fetch_assoc()) {
        $content = $row2['content'];
        $date = $row2['date'];
?>

        <!-- Displaying the content for the current user -->
        <div class="testimonial-item">
            <i class="fa fa-quote-right"></i>
            <div class="row align-items-center">
                <div class="col-9">
                    <h2><?= $name; ?></h2>
                    <h5><?= $date; ?></h5>
                </div>
                <div class="col-12">
                    <p><?= htmlspecialchars($content); ?></p>
                </div>
            </div>
        </div>

<?php
    }
} else {
    echo "<p>No inquiries found for this user.</p>";
}

// Fetching inquiry data for userid = 9 (or another logic if needed)
$sql1 = "SELECT * FROM inquiry WHERE userid = 9"; // Change this logic as needed
$res1 = $conn->query($sql1);
$sql2="SELECT * FROM user WHERE id=9";
$res2=$conn->query($sql2); 
$row2=$res2->fetch_assoc();
$nameadmin=$row2['fname']." ".$row2['lname'];
if ($res1->num_rows > 0) {
    while ($row1 = $res1->fetch_assoc()) {
        $message = $row1['content'];
        $date = $row1['date'];
?>

        <!-- Displaying the inquiry for userid = 9 -->
        <div class="testimonial-item">
            <i class="fa fa-quote-right"></i>
            <div class="row align-items-center">
                <div class="col-9">
                    <h2>Legal Administrative,<?= $nameadmin ; ?></h2>
                    <h5><?= $date; ?></h5>
                </div>
                <div class="col-12">
                    <p><?= htmlspecialchars($message); ?></p>
                </div>
            </div>
        </div>

<?php
    }
} else {
    echo "";
}
?>
<!-- Testimonal End -->
            </div>
        </div>
    <?php
} else {
?>

  <div class="col-md-6">
                    <div class="contact-form">
                        <form method="post" action="">
                            <div class="alert alert-warning" role="alert">
                <strong>Notice:</strong> Please log in to send a formal inquiry to the Legal Administrative Office.
            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name" readonly />
                                
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email" readonly />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Message" required="required" rows="5" readonly ></textarea>
                            </div>
                            <div>
                               <button class="btn" type="submit">
                                    <i class="fa fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
    ?>
    <!-- Contact End -->
    <br>
<br>

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