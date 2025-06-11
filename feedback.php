<?php
session_start();
include 'checkStatus.php';
include 'header.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Client Feedback</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Feedback" name="keywords">
    <meta content="Share your experience with our legal services" name="description">

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
    <link href="css/feedback.css" rel="stylesheet">

    

<!-- Ensure Font Awesome is loaded -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Users Feedback</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="feedback.php">Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="section-header">
                <h2>What Our Clients Say</h2>
            </div>
            <div class="owl-carousel testimonials-carousel">
                <?php
                // Fetch testimonials from database
                $sql = "SELECT * FROM feedback ";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="testimonial-item">
                            <i class="fa fa-quote-right"></i>
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="img/testimonial-<?= rand(1, 4); ?>.jpg" alt="Client">
                                </div>
                                <div class="col-9">
                                    <h2><?= htmlspecialchars($row['name']); ?></h2>
                                    <p class="profession"><?= htmlspecialchars($row['casename']); ?></p>
                                    <div class="rating">
    <?php
    $rating = isset($row['rating']) ? (int)$row['rating'] : 0;

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            echo '<i class="fas fa-star" style="color: gold; font-size: 20px;"></i>'; // Gold star
        } else {
            echo '<i class="far fa-star" style="color: gray; font-size: 20px;"></i>'; // Gray star
        }
    }
    ?>
</div>
                                </div>
                                <div class="col-12">
                                    <p><?= htmlspecialchars($row['comment']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                 } 
                 ?>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
     <?php
     if (isset($_SESSION['user'])) {
     $id=$_SESSION['user']['id'];
     $email=$_SESSION['user']['email'];
     $name=$_SESSION['user']['fullName'];
     
$sql2="SELECT * FROM `case` where userid='$id'";
$res2 = $conn->query($sql2);
if($res2->num_rows > 0){
     ?>

    <!-- Feedback Form Section Start -->
    <section class="feedback-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="form-container">
                        <h2 class="section-title text-center">Share Your Experience</h2>
                        <p class="text-center mb-4">We value your feedback. Please take a moment to share your experience with our legal services.</p>

                        <?php if (isset($success_message)): ?>
                            <div class="alert alert-success">
                                <?= $success_message ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger">
                                <?= $error_message ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="userfeedback.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Your Name *</label>
                                        <input type="text" class="form-control" placeholder="<?= $name ;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Your Email *</label>
                                        <input type="email" class="form-control" placeholder="<?= $email ;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Your Case *</label>
                                        <input type="text" class="form-control" name="casename" placeholder="...." required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Your Rating *</label>
                                <div class="star-rating">
                                    <input type="radio" id="star5" name="rating" value="5" required>
                                    <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="message">Your Feedback *</label>
                                <textarea class="form-control" id="message" name="comment" rows="5" required></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" name="submit_feedback" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} else {
    echo '<div class="alert alert-warning text-center" role="alert">
        <strong>You have no cases to provide feedback on.</strong>';
}
     }
?>
    <!-- Feedback Form Section End -->


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
        // Initialize the testimonial carousel
        $(document).ready(function() {
            $(".testimonials-carousel").owlCarousel({
                autoplay: true,
                dots: true,
                loop: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        });

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