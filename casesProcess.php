<?php
session_start();
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to the login page
    header('Location: login.php');
    exit(); // Ensure the rest of the code doesn't execute
} else {
    include 'checkStatus.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Book a Case</title>
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
    <link href="css/casesprocess.css" rel="stylesheet">

</head>

<body>
    <!-- Header would be included here -->
    <?php include 'header.php'; ?>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Book a Case</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="cases.php">Case Studies</a>
                    <a href="#">Book Case</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Booking Form Section Start -->
    <section class="booking-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form id="myForm" class="shadow p-4 bg-white">
                        <h2 class="section-title">Book Your Consultation</h2>
                        <div class="mb-4">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="email" class="form-control" value="<?= $_SESSION['user']['fullName']; ?>" readonly>
                        </div>

                        <?php
                        $cat = $_GET['id'];
                        $sql3 = "SELECT * FROM `category` WHERE id='$cat'";
                        $res3 = $conn->query($sql3);
                        $row3 = $res3->fetch_assoc();
                        $name = $row3['name'];
                        $desc = $row3['description'];
                        $id = $row3['id'];
                        ?>

                        <div class="mb-4">
                            <label class="form-label">Case Type</label>
                            <h3 class="mb-0"><?= $name ?> Case</h3>
                            <input type="hidden" name="cat" value="<?= $cat; ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Case Description</label>
                            <textarea id="textarea" name="textarea" class="form-control" placeholder="Describe your case here..." rows="5"></textarea>
                            <div class="word-count mt-2">
                                <span id="current-word-count">0</span> / 150 words
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" onclick="getatt()" class="btn btn-primary">Find Attorneys</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Booking Form Section End -->

    <!-- Attorneys Section Start -->
    <section class="attorneys-section">
        <div class="container">
            <div id="attorney" class="row" style="display:none">
                <div class="col-12 mb-5 text-center">
                    <h2 class="section-title mx-auto" style="display: inline-block;">Available Attorneys</h2>
                </div>

                <?php
                $sql4 = "SELECT * FROM practicearea WHERE id ='$cat'";
                $res4 = $conn->query($sql4);
                $row4 = $res4->fetch_assoc();
                $name = $row4['name'];

                $sql = "SELECT * FROM attorneys WHERE specialized ='$name'";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    $userid = $row['userid'];
                    $sql1 = "SELECT * FROM user WHERE id='$userid'";
                    $res1 = $conn->query($sql1);
                    while ($row1 = $res1->fetch_assoc()) {
                        $fname = $row1['fname'];
                        $lname = $row1['lname'];
                ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="attorney-card">
                                <div class="attorney-image">
                                    <img src="<?= $row1['image']; ?>" alt="<?= $fname . " " . $lname; ?>">
                                </div>
                                <div class="attorney-info">
                                    <h3><?= $fname . " " . $lname; ?></h3>
                                    <div class="attorney-meta">
                                        <p><i class="fas fa-gavel"></i> <?= $row['specialized'] . " Law"; ?></p>

                                        <?php
                                        $sql2 = "SELECT * FROM cv where userid='$userid'";
                                        $res2 = $conn->query($sql2);
                                        while ($row2 = $res2->fetch_assoc()) {
                                            $id = $row2['id'];
                                            $sql3 = "SELECT * FROM experience WHERE cvid='$id'";
                                            $res3 = $conn->query($sql3);
                                            $tot = 0;
                                            while ($row3 = $res3->fetch_assoc()) {
                                                $nb = $row3['nbofyears'];
                                                $tot += $nb;
                                            }
                                        ?>
                                            <p><i class="fas fa-clock"></i> <?= $tot; ?> Years of Experience</p>
                                            <p><i class="fas fa-university"></i> <?= $row2['university']; ?></p>
                                        <?php } ?>
                                    </div>

                                    <div class="d-flex justify-content-between mt-3">
                                        <!-- Form to submit to book.php -->
                                        <form action="book.php" method="post">
                                            <input type="hidden" name="attorney_id" value="<?= $row['userid']; ?>">
                                            <input type="hidden" name="textarea" id="textarea_value_<?= $row['userid']; ?>" class="textarea_clone">
                                            <input type="hidden" name="cat" value="<?= $cat ?>">
                                            <button type="submit" class="btn btn-primary">Book Now</button>
                                        </form>

                                        <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#attorneyModal<?= $row['userid']; ?>">
                                            Read More <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for attorney details -->
                        <div class="modal fade" id="attorneyModal<?= $row['userid']; ?>" tabindex="-1" aria-labelledby="attorneyModalLabel<?= $row['userid']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="attorneyModalLabel<?= $row['userid']; ?>"><?= $fname . " " . $lname; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?= $row['description']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Attorneys Section End -->

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
        const textarea = document.getElementById('textarea');
        const wordCountDisplay = document.getElementById('current-word-count');
        const maxWords = 150;

        // Count words function
        function countWords(text) {
            return text.trim().split(/\s+/).filter(word => word.length > 0).length;
        }

        // Textarea input event listener
        textarea.addEventListener('input', function() {
            let text = textarea.value;
            let wordCount = countWords(text);

            if (wordCount > maxWords) {
                const trimmedText = text.split(/\s+/).slice(0, maxWords).join(' ');
                textarea.value = trimmedText;
                wordCount = maxWords;
            }

            wordCountDisplay.textContent = wordCount;
        });

        // Form submit event handler
        let form = document.getElementById('myForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Clone textarea value to all hidden inputs
            const allTextareaClones = document.querySelectorAll('.textarea_clone');
            const textareaValue = document.getElementById('textarea').value;

            allTextareaClones.forEach(function(input) {
                input.value = textareaValue;
            });

            // Show attorneys section
            getatt();
        });

        // Function to display attorneys
        function getatt() {
            document.getElementById("attorney").style.display = "flex";
            document.getElementById("attorney").scrollIntoView({
                behavior: "smooth"
            });
        }

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