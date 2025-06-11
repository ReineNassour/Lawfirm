<?php
session_start();
include 'checkStatus.php';
include 'header.php';

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
                    <h2>Our Attorneys</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="attorneys.php">Our Attorneys</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Attorneys Section Start -->
    <section class="attorneys-section">
        <div class="container">
            <div class="section-header">
                <h2>The Firm's Lawyers</h2>
            </div>

            <div class="row">
                <?php
                $sql = "SELECT * FROM user WHERE role=2";
                $res = $conn->query($sql);

                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $id = $row['id'];

                        // Get attorney specialization
                        $sql1 = "SELECT * FROM attorneys WHERE userid='$id'";
                        $res1 = $conn->query($sql1);
                        $specializationText = "";

                        if ($res1 && $res1->num_rows > 0) {
                            $row1 = $res1->fetch_assoc();
                            $specializationText = $row1['specialized'];
                        }

                        // Get CV details
                        $sql2 = "SELECT * FROM cv WHERE userid='$id'";
                        $res2 = $conn->query($sql2);
                        $graduationYear = "";
                        $university = "";
                        $description = "";

                        if ($res2 && $res2->num_rows > 0) {
                            $row2 = $res2->fetch_assoc();
                            $graduationYear = $row2['year'];
                            $university = $row2['university'];
                            $description = $row2['description'];
                        }
                      ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="attorney-card">
                                <div class="attorney-image">
                                    <img src="<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?>">

                                </div>
                                <div class="attorney-info" >
                                    <h3><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></h3>

                                    <div class="attorney-meta">
                                        <?php if (!empty($specializationText)) { ?>
                                            <div class="attorney-meta-item">
                                                <i class="fas fa-gavel"></i>
                                                <p><?= htmlspecialchars($specializationText); ?> Law</p>
                                            </div>
                                        <?php } ?>

                                        <?php if (!empty($graduationYear)) { ?>
                                            <div class="attorney-meta-item">
                                                <i class="fas fa-calendar-alt"></i>
                                                <p>Graduated <?= htmlspecialchars($graduationYear); ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if (!empty($university)) { ?>
                                        <p class="attorney-text"><?= htmlspecialchars($university); ?></p>
                                    <?php } ?>

                                    <a class="btn btn-outline" href="#" data-bs-toggle="modal" data-bs-target="#attorneyModal<?= $id; ?>">
                                        Read More <i class="fas fa-angle-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for this attorney -->
                        <div class="modal fade" id="attorneyModal<?= $id; ?>" tabindex="-1" aria-labelledby="attorneyModalLabel<?= $id; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="attorneyModalLabel<?= $id; ?>">
                                            <?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?> -
                                            <?php if (!empty($specializationText)) { ?>
                                                Specialized in <?= htmlspecialchars($specializationText); ?> Law
                                            <?php } else { ?>
                                                Attorney at TheFirm
                                            <?php } ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-4 mb-md-0">
                                                <img src="<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?>" class="img-fluid">
                                            </div>
                                            <div class="col-md-8">
                                                <h4>Professional Profile</h4>
                                                <?php if (!empty($description)) { ?>
                                                    <p><?= htmlspecialchars($description); ?></p>
                                                <?php } else { ?>
                                                    <p>A dedicated legal professional with expertise in <?= htmlspecialchars($specializationText); ?> Law. <?= htmlspecialchars($row['fname']); ?> has successfully represented numerous clients and continues to provide exceptional legal services.</p>
                                                <?php } ?>

                                                <h4 class="mt-4">Education</h4>
                                                <p><?= htmlspecialchars($university); ?>, Class of <?= htmlspecialchars($graduationYear); ?></p>

                                                <h4 class="mt-4">Contact Information</h4>
                                                <p><i class="fas fa-envelope me-2"></i> <?= strtolower($row['fname']) . '.' . $row['lname']; ?>@thefirm.com</p>
                                                <p><i class="fas fa-phone me-2"></i> (123) 456-7890</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="contact.php" class="btn btn-primary">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12"><p class="text-center">No attorneys found.</p></div>';
                }
                ?>
            </div>

            <!-- Only show pagination if there are multiple attorneys -->
            <?php if ($res && $res->num_rows > 3) { ?>
                <div class="row">
                    <div class="col-12">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Attorneys Section End -->

    <div class="section-header">
                <h2>Your Lawyers For Life</h2>
            </div>

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