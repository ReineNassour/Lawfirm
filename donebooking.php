<?php
session_start();
include 'checkStatus.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Booking Confirmation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Booking Confirmation" name="keywords">
    <meta content="Booking confirmation page for legal consultations" name="description">

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
    <style>
        :root {
            --primary: #9d8e69;
            --primary-dark: #7d6e49;
            --primary-light: #d5cbb8;
            --secondary: #2e3b4e;
            --secondary-light: #4a5b6e;
            --secondary-dark: #1e2b3e;
            --accent: #a32c38;
            --light: #f8f8f8;
            --dark: #111827;
            --gray: #6b7280;
            --gray-light: #d1d5db;
            --white: #ffffff;
            --header-height: 90px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            color: var(--secondary-dark);
            line-height: 1.7;
            overflow-x: hidden;
            background-color: var(--light);
            position: relative;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cormorant', serif;
            font-weight: 700;
            line-height: 1.3;
            color: var(--secondary-dark);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        /* Page Header Styles */
        .page-header {
            position: relative;
            height: 350px;
            display: flex;
            align-items: center;
            background-image: url('img/carousel-1.jpg');
            background-size: cover;
            background-position: center;
            margin-bottom: 60px;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(17, 24, 39, 0.9), rgba(17, 24, 39, 0.7));
            z-index: 1;
        }

        .page-header .container {
            position: relative;
            z-index: 2;
        }

        .page-header h2 {
            font-size: 48px;
            color: var(--white);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
        }

        .page-header h2::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background-color: var(--primary);
            bottom: 0;
            left: 0;
        }

        .page-header .breadcrumb {
            display: flex;
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .page-header a {
            color: var(--gray-light);
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            padding: 0 5px;
        }

        .page-header a:hover {
            color: var(--primary);
        }

        .page-header a:not(:last-child):after {
            content: '/';
            margin: 0 10px;
            color: var(--gray-light);
        }

        /* Confirmation Section Styles */
        .confirmation-section {
            padding: 80px 0 100px;
        }

        .confirmation-card {
            background-color: var(--white);
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .confirmation-icon {
            font-size: 80px;
            color: var(--primary);
            margin-bottom: 30px;
        }

        .confirmation-title {
            font-size: 36px;
            margin-bottom: 20px;
            color: var(--secondary-dark);
        }

        .confirmation-text {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 0;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }

        .btn::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            transition: all 0.3s;
            z-index: -1;
        }

        .btn:hover {
            color: #fff;
        }

        .btn:hover::before {
            width: 100%;
        }

        .btn-primary {
            color: #fff;
            background-color: var(--primary);
            border: none;
        }

        .btn-primary::after {
            background-color: var(--primary);
        }

        .btn-primary::before {
            background-color: var(--secondary-dark);
        }

        .steps {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .step {
            text-align: center;
            padding: 0 20px;
            position: relative;
        }

        .step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 35px;
            right: -10px;
            width: 20px;
            height: 2px;
            background-color: var(--primary-light);
        }

        .step-icon {
            width: 70px;
            height: 70px;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .step-icon i {
            font-size: 28px;
            color: var(--primary);
        }

        .step-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--secondary-dark);
        }

        .step-text {
            font-size: 14px;
            color: var(--gray);
        }

        .active .step-icon {
            background-color: var(--primary);
        }

        .active .step-icon i {
            color: var(--white);
        }

        @media (max-width: 767.98px) {
            .page-header {
                height: 250px;
            }

            .page-header h2 {
                font-size: 36px;
            }

            .confirmation-card {
                padding: 30px;
            }

            .confirmation-title {
                font-size: 28px;
            }

            .steps {
                flex-direction: column;
                align-items: center;
            }

            .step {
                margin-bottom: 30px;
            }

            .step:not(:last-child):after {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Header would be included here -->
    <?php include 'header.php'; ?>

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Booking Confirmation</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="cases.php">Cases</a>
                        <a href="#">Booking Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Confirmation Section Start -->
    <section class="confirmation-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="confirmation-card">
                            <div class="confirmation-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h2 class="confirmation-title">Booking Successfully Submitted</h2>
                            <p class="confirmation-text">
                                Thank you, <strong><?= $_SESSION['user']['fullName']; ?></strong>, for booking with us. Your case has been registered in our system and is now awaiting attorney review. You will receive further communication regarding your appointment details and next steps.
                            </p>
                            
                            <div class="steps">
                                <div class="step active">
                                    <div class="step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <h4 class="step-title">Booking Submitted</h4>
                                    <p class="step-text">Your case details have been received</p>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <h4 class="step-title">Attorney Review</h4>
                                    <p class="step-text">Your case is under review</p>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <h4 class="step-title">Consultation</h4>
                                    <p class="step-text">Meet with your attorney</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <a href="index.php" class="btn btn-primary">
                                    <i class="fas fa-home me-2"></i>Return to Home
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php header("Location: login.php"); exit; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Confirmation Section End -->

    <!-- Footer would be included here -->
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