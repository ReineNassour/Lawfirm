<?php
session_start();
include 'checkStatus.php';
if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Application Submitted</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Application" name="keywords">
    <meta content="Application submission confirmation page" name="description">

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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
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

        /* Header Styles */
        .header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            padding: 25px 0;
            transition: all 0.4s ease;
        }

        .header.sticky {
            position: fixed;
            background-color: rgba(17, 24, 39, 0.95);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            animation: fadeInDown 0.5s ease;
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
                    <h2>Application Submitted</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="#">Application Status</a>
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
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h2 class="confirmation-title">Application Successfully Submitted</h2>
                            <p class="confirmation-text">
                                Thank you, <strong><?= $_SESSION['user']['fullName']; ?></strong>, for your application. Our team will review your information and get back to you shortly. Please check your email regularly for updates.
                            </p>
                            <div class="mt-4">
                                <a href="index.php" class="btn btn-primary">
                                    <i class="fas fa-home me-2"></i>Return to Home
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php header("Location: login.php");
                        exit; ?>
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