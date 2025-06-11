<?php
session_start();
include 'checkStatus.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Practice Areas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Practice Areas" name="keywords">
    <meta content="Explore our comprehensive legal practice areas and specializations" name="description">

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
    <link href="css/practice.css" rel="stylesheet">

<style>
    .page-header {
    height: 350px;
    display: flex;
    align-items: center; 
    justify-content: center;
    background-color: #f5f5f5; 
    padding: 20px 0;
}
</style>

</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Practice Areas</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="practice.php">Practice Areas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>Our Practice Areas</h2>
            </div>

            <div class="row">
                <?php
                $sql = "SELECT * FROM `practicearea`";
                $res = $conn->query($sql);

                // Define icons for different practice areas
                $icons = [
                    'Civil' => 'fa-landmark',
                    'Family' => 'fa-users',
                    'Criminal' => 'fa-gavel',
                    'Business' => 'fa-briefcase',
                    'Immigration' => 'fa-globe',
                    'Real Estate' => 'fa-home',
                    'Intellectual Property' => 'fa-lightbulb',
                    'Tax' => 'fa-file-invoice-dollar',
                    'Employment' => 'fa-user-tie',
                    'Environmental' => 'fa-leaf'
                ];

                while ($row = $res->fetch_assoc()) {
                    // Determine icon based on practice area name
                    $icon = 'fa-balance-scale'; // Default icon
                    foreach ($icons as $keyword => $iconClass) {
                        if (stripos($row['name'], $keyword) !== false) {
                            $icon = $iconClass;
                            break;
                        }
                    }
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="fas <?= $icon; ?>"></i>
                            </div>
                            <h3><?= $row['name']; ?> Law</h3>
                            <p><?= substr($row['description'], 0, 150); ?>...</p>
                            <a class="btn" href="#" data-bs-toggle="modal" data-bs-target="#modal<?= $row['id']; ?>">Learn More</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> 
    <!-- Service End -->

    <!-- Modals Start -->
    <?php
    // Reset the pointer to the first row of the result set
    $res->data_seek(0);
    while ($row = $res->fetch_assoc()) {
    ?>
        <div class="modal fade" id="modal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $row['id']; ?>"><?= $row['name']; ?> Law</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mb-4"><?= $row['description']; ?></p>

                                <h1>Practice Rules & Guidelines</h1>
                                <p><?= $row['rules']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Modals End -->

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