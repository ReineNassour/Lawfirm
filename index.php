<?php
session_start();
include 'checkStatus.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Premier Legal Services</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys" name="keywords">
    <meta content="Professional legal services for all your needs" name="description">

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

    <link href="css/indexstyle.css" rel="stylesheet">


    <!-- Custom Styles -->

</head>

<body>


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-slider">
            <div class="hero-slide" style="background-image: url('img/carousel-1.jpg');"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <span class="hero-subtitle">Legal Excellence</span>
                        <h1 class="hero-title">We Fight For Your Justice With Experience</h1>
                        <p class="hero-text">Trusted legal expertise for individuals and businesses. Our attorneys provide strategic counsel and vigorous representation to protect your rights and achieve the best possible outcomes.</p>
                        <div class="hero-buttons">
                            <a href="cases.php" class="btn btn-primary">Book A Case</a>
                            <a href="chatbot.php" class="btn btn-outline">Ask Our Bot</a>
                            <a href="apply.php" class="btn btn-outline">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-pagination">
            <div class="hero-pagination-item active"></div>
            <div class="hero-pagination-item"></div>
            <div class="hero-pagination-item"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="practice.php" class="d-block h-100">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="far fa-check-circle"></i>
                            </div>
                            <h3 class="feature-title">Legal Practices</h3>
                            <p class="feature-text">Government approved legal practices with proven track record</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="attorneys.php" class="d-block h-100">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa fa-user-tie"></i>
                            </div>
                            <h3 class="feature-title">Expert Attorneys</h3>
                            <p class="feature-text">Our team of highly skilled and experienced legal professionals</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="feedback.php" class="d-block h-100">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="far fa-thumbs-up"></i>
                            </div>
                            <h3 class="feature-title">Client Feedback</h3>
                            <p class="feature-text">Share your experience and help us improve our services</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="contact.php" class="d-block h-100">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="far fa-handshake"></i>
                            </div>
                            <h3 class="feature-title">Quick Support</h3>
                            <p class="feature-text">Responsive and reliable client service and support</p>
                        </div>
                    </a>
                </div>
               
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="section-subtitle">Why Choose Us</span>
                    <h2 class="section-title">Excellence in Legal Representation for Over 15 Years</h2>
                    <p class="about-text">At TheFirm, we combine extensive legal knowledge with strategic thinking to deliver exceptional results for our clients. Our approach is built on understanding your unique needs and crafting solutions that protect your interests and achieve your goals.</p>

                    <div class="about-features">
                        <div class="about-feature">
                            <div class="about-feature-title">
                                <div class="about-feature-icon">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <h4 class="about-feature-text">Best Law Practices</h4>
                            </div>
                            <p class="about-feature-desc">We adhere to the highest ethical standards and most effective legal strategies.</p>
                        </div>

                        <div class="about-feature">
                            <div class="about-feature-title">
                                <div class="about-feature-icon">
                                    <i class="fa fa-balance-scale"></i>
                                </div>
                                <h4 class="about-feature-text">Efficiency & Trust</h4>
                            </div>
                            <p class="about-feature-desc">Our streamlined processes ensure timely results while maintaining complete transparency.</p>
                        </div>

                        <div class="about-feature">
                            <div class="about-feature-title">
                                <div class="about-feature-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <h4 class="about-feature-text">Proven Results</h4>
                            </div>
                            <p class="about-feature-desc">Our track record speaks for itself with numerous successful case resolutions.</p>
                        </div>

                        <div class="about-feature">
                            <div class="about-feature-title">
                                <div class="about-feature-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h4 class="about-feature-text">Client Protection</h4>
                            </div>
                            <p class="about-feature-desc">We go above and beyond to safeguard your interests at every step.</p>
                        </div>
                    </div>

                    <a href="practice.php" class="btn btn-primary mt-4">Learn More</a>
                </div>

                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="img/faqs.jpg" alt="Why Choose Us" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
     </section>

     <!-- Team Section -->
     <section class="team">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-subtitle">Our Attorneys</span>
                <h2 class="section-title text-center">Meet Our Expert Legal Team</h2>
            </div>

            <?php
            $res11 = $conn->query("
    SELECT a.*, u.fname, u.lname, u.image 
    FROM attorneys a
    JOIN user u ON a.userid = u.id
    WHERE u.role = 2
    ORDER BY a.userid ASC
    LIMIT 4
");

            ?>

            <div class="row">
                <div class="row"> <!-- Add this row wrapper -->
                    <?php while ($row11 = $res11->fetch_assoc()): ?>
    <div class="col-lg-3 col-md-6">
        <div class="team-card">
            <div class="team-image">
                <img src="<?= $row11['image']; ?>" alt="<?= $row11['fname']; ?>">
                <div class="team-social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3 class="team-name"><?= $row11['fname'] . " " . $row11['lname']; ?></h3>
                <div class="team-separator"></div>
                <p class="team-position">Specialized In <b><?= $row11['specialized']; ?></b> Law</p>
            </div>
        </div>
    </div>
<?php endwhile; ?>

                </div> <!-- End row -->


                <div class="text-center mt-5">
                    <a href="attorneys.php" class="btn btn-primary">View All Attorneys</a>
                </div>
            </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-about">
                            <h3>About TheFirm</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eu lectus a leo tristique dictum nec non quam. Suspendisse convallis, tortor eu placerat rhoncus, lorem quam iaculis felis, sed eleifend lacus neque id eros.</p>
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-links">
                            <h3>Practice Areas</h3>
                            <ul>
                                <li><a href="cases.php">Civil Law</a></li>
                                <li><a href="cases.php">Family Law</a></li>
                                <li><a href="cases.php">Business Law</a></li>
                                <li><a href="cases.php">Education Law</a></li>
                                <li><a href="cases.php">Criminal Law</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-contact">
                            <h3>Get In Touch</h3>
                            <p><i class="fa fa-map-marker-alt"></i> Qubic Square Business, Sin El Fil, Beirut, Lebanon</p>
                            <p><i class="fa fa-phone-alt"></i> +012 345 67890</p>
                            <p><i class="fa fa-envelope"></i> TheFirm@gmail.com</p>
                            <p><i class="fa fa-clock"></i> Monday - Friday: 8:00 AM - 9:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="footer-menu">
                <a href="#">Terms of Use</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Cookies</a>
                <a href="#">Help</a>
                <a href="#">FAQs</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <a href="#">TheFirm</a>, All Rights Reserved.</p>
            </div>
        </div>
    </footer>

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

        // Hero Slider
        $(document).ready(function() {
            // Initialize variables
            let currentSlide = 0;
            const slides = ['img/carousel-1.jpg', 'img/carousel-2.jpg', 'img/carousel-3.jpg'];
            const slideTitles = [
                'We Fight For Your Justice With Experience',
                'We Are Prepared To Oppose For You',
                'Defending Your Rights, Protecting Your Future'
            ];
            const slideTexts = [
                'Trusted legal expertise for individuals and businesses. Our attorneys provide strategic counsel and vigorous representation.',
                'Trusted Legal Solutions for Every Case. Our attorneys work tirelessly to achieve the best possible outcome.',
                'We provide comprehensive legal services to protect what matters most to you and secure your future.'
            ];

            // Function to change slide
            function changeSlide() {
                currentSlide = (currentSlide + 1) % slides.length;

                // Fade out current slide
                $('.hero-slide').fadeOut(500, function() {
                    // Change background image
                    $(this).css('background-image', 'url(' + slides[currentSlide] + ')');

                    // Update content with animation
                    $('.hero-title').fadeOut(300, function() {
                        $(this).text(slideTitles[currentSlide]).fadeIn(300);
                    });

                    $('.hero-text').fadeOut(300, function() {
                        $(this).text(slideTexts[currentSlide]).fadeIn(300);
                    });

                    // Update pagination
                    $('.hero-pagination-item').removeClass('active');
                    $('.hero-pagination-item:eq(' + currentSlide + ')').addClass('active');

                    // Fade in new slide
                    $(this).fadeIn(500);
                });
            }

            // Set interval for slide change
            setInterval(changeSlide, 5000);

            // Pagination click event
            $('.hero-pagination-item').click(function() {
                const index = $(this).index();
                if (index !== currentSlide) {
                    currentSlide = index - 1; // -1 because changeSlide will increment it
                    changeSlide();
                }
            });
        });
    </script>
</body>

</html>