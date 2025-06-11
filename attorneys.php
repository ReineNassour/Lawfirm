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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <style>
    .page-header {
    height: 300px;
    display: flex;
    align-items: center; 
    justify-content: center;
    background-color: #f5f5f5; 
    padding: 20px 0;
}


.rating {
            direction: rtl; /* Right to left for natural selection */
            text-align: center;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 30px;
            color: gray;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
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

            <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="section-header">
                <h2>Our Clients' Ratings for Their Attorneys</h2>
            </div>
            <div class="owl-carousel testimonials-carousel">
                <?php
                
                $sql = "SELECT * FROM rate ";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                           $caseid=$row['caseid'];

                $sql1 = "SELECT * FROM `case` where id='$caseid'";
                $res1 = $conn->query($sql1);
                $row1=$res1->fetch_assoc();
                $userid=$row1['userid'];
                $category=$row1['categoryid'];

                $sql3 = "SELECT * FROM category where id='$category' ";
                $res3 = $conn->query($sql3);
                $row3=$res3->fetch_assoc();

                $sql2 = "SELECT * FROM user where id='$userid' ";
                $res2 = $conn->query($sql2);
                $row2=$res2->fetch_assoc();


                ?>
                        <div class="testimonial-item">
                            <i class="fa fa-quote-right"></i>
                            <div class="row align-items-center">
                               
                                <div class="col-9">
                                    <h2><?= htmlspecialchars($row2['fname']." ".$row2['lname']); ?></h2>
                                    <p class="profession"><?= htmlspecialchars($row3['name'])." Case"; ?></p>
                                    <div class="rating">
                                 <?php
                              $rating = isset($row['rate']) ? (int)$row['rate'] : 0;

                         for ($i = 1; $i <= 5; $i++) {
                         if ($i <= $rating) {
                            echo '<i class="far fa-star" style="color: gray; font-size: 20px;"></i>'; // Gray star
                       
                         } else {
                            echo '<i class="fas fa-star" style="color: gold; font-size: 20px;"></i>'; // Gold star
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
    </div><hr><br><br>


    <?php
    
    if (isset($_SESSION['user']['id'])) {
        $userId = $_SESSION['user']['id'];
        $email = $_SESSION['user']['email'];
        $name = $_SESSION['user']['fullName'];
        // Check if case ID exists in URL parameters
        $caseid = isset($_GET['id']) ? $_GET['id'] : null;
        
        // Only query cases if we have a valid case ID
        if ($caseid) {
            $sql2 = "SELECT * FROM `case` WHERE userid='$userId' AND casestatus='Pending'";
            $res2 = $conn->query($sql2);

            if ($res2->num_rows > 0) {

     ?>

    <!-- Feedback Form Section Start -->
    <section class="feedback-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="form-container">
                        <h2 class="section-title text-center">Share Your Experience</h2>
                        <p class="text-center mb-4">We value your Rating. Please take a moment to share your experience with Your Attorney.</p>

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

                        <form method="POST" action="attorneysRating.php">
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
                                <input type="hidden" name="caseid" value="<?= $caseid; ?>">
                               <br><br>

                                <div class="col-md-6">
 <div class="form-group">
    <label class="form-label"><b>Your Rating *</b></label>
    <div class="star-rating">

        <input type="radio" id="star1" name="rating" value="1">
        <label for="star1" title="1 star"><i class="fas fa-star"></i></label>

        <input type="radio" id="star2" name="rating" value="2">
        <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>

        <input type="radio" id="star3" name="rating" value="3">
        <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>

        <input type="radio" id="star4" name="rating" value="4">
        <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>

        <input type="radio" id="star5" name="rating" value="5" required>
        <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>

    </div>
  </div>
</div>

<style>
   .star-rating {
        display: flex;
        flex-direction: row-reverse; /* Reverses star order (5 on the right, 1 on the left) */
        gap: 5px;
        justify-content: flex-start; /* Align stars to the left side of the screen */
    }

    .star-rating label {
        font-size: 30px;
        cursor: pointer;
    }

    .star-rating input {
        display: none; /* Hide radio buttons */
    }

    /* Default star style - transparent inside, yellow border */
    .star-rating label i {
        color: transparent; /* Makes the inside transparent */
        -webkit-text-stroke: 2px gold; /* Creates a yellow border */
        transition: color 0.3s ease;
    }

    /* When a radio button is checked, color the corresponding star */
    .star-rating input:checked ~ label i {
        color: gold; /* Fills the star with gold */
        -webkit-text-stroke: 0px; /* Removes the border */
    }

    /* Hover effect to preview the rating before clicking */
    .star-rating label:hover i,
    .star-rating label:hover ~ label i {
        color: rgba(255, 215, 0, 0.5); /* Slightly gold on hover */
    }
</style>


                            <div class="form-group"><br>
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
                <strong>" You need to have a case to provide feedback on an attorney. "</strong>
              </div>';
    }
} else {
    echo '<div class="alert alert-info text-center" role="alert">
            <strong>" Please Go To <a href="track.php" style="text-decoration:underline;">Track your Case</a> Page and choose a case to leave your feedback. "</strong>
          </div>';
}
}

?>
<br><br>

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