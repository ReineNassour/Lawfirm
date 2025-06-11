<?php
session_start();
include 'checkStatus.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Case Studies</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Case Studies" name="keywords">
    <meta content="Browse our successful case studies and legal work" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    
    <link href="css/cases.css" rel="stylesheet">
</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Case Studies</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="cases.php">Case Studies</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Start -->
    <div class="portfolio">
        <div class="container">
            <div class="section-header">
                <h2>Our Case Studies</h2>
            </div>

            <?php
            include 'db.php';
            $sql = "SELECT * FROM category";
            $res = $conn->query($sql);
            ?>

            <div class="row portfolio-container">
                <?php
                while ($row = $res->fetch_assoc()) {
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first mb-4">
                        <a href="casesProcess.php?id=<?= $row['id'] ?>">
                            <div class="portfolio-wrap">
                                <img src="<?= $row['image']; ?>" alt="Portfolio Image">
                                <figure>
                                    <p><?= $row['name']; ?></p>
                                    <p><?= $row['description']; ?></p>
                                    <span>01-Jan-2045</span>
                                </figure>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Portfolio End -->

    <?php include 'footer.php'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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