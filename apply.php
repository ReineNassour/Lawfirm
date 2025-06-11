<?php
ob_start();
session_start(); 
if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
include 'checkStatus.php';
include 'header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Attorney Application</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Apply" name="keywords">
    <meta content="Apply to join our team of legal professionals" name="description">

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
    
    <link href="css/apply.css" rel="stylesheet">

</head>

<body>
    <!-- Header would be included here -->

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Join Our Team</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="apply.php">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Application Content Start -->
    <section class="form-section">
        <div class="container">
            <?php
            if (isset($_SESSION['user'])) {
                $userid = $_SESSION['user']['id'];

                $sql2 = "SELECT * FROM `cv` WHERE userid='$userid'";
                $res = $conn->query($sql2);
                if ($res->num_rows > 0) {
                    // User already has an application
            ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="application-message">
                                <i class="fas fa-hourglass-half"></i>
                                <h1>Application In Progress</h1>
                                <p class="mb-4">You have already submitted an application. Our team is currently reviewing your credentials. Please be patient as we process your application.</p>
                                <a href="index.php" class="btn btn-primary">Return to Home</a>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    // User can apply
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $univ = $_POST['univ'];
                        $year = $_POST['year'];
                        $level = $_POST['certificate'];
                        $desc = $_POST['learn'];
                        $selectedSkill = $_POST['skill'];

                        $sql = "INSERT INTO cv (university, year, level, description, specialized ,status ,userid) VALUES ('$univ', '$year', '$level', '$desc','$selectedSkill' ,'Pending' ,'$userid')";
                        if ($conn->query($sql) === TRUE) {
                            header("Location: experience.php");
                            exit();
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    }
                
                
                ?>
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="form-container">
                                <h2 class="section-title">Attorney Application</h2>
                                <p class="mb-4">We're looking for talented legal professionals to join our team. Please provide your educational background and qualifications below.</p>

                                <form action="" method="POST">
                                    <div class="form-group">
                                        <h3 class="form-title">Educational Background</h3>
                                        <div class="mb-4">
                                            <label for="univ" class="form-label">Which university did you graduate from?</label>
                                            <input type="text" name="univ" id="univ" class="form-control" placeholder="Enter your university name" required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="year" class="form-label">When did you graduate from the university?</label>
                                            <input type="date" name="year" id="year" class="form-control" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h3 class="form-title">Additional Qualifications</h3>
                                        <div class="mb-4">
                                            <label for="certificate" class="form-label">Are there any other certifications you hold?</label>
                                            <textarea id="area" name="certificate" class="form-control" placeholder="List any additional certifications, credentials, or specialized training you've received..." rows="5" required></textarea>
                                            <div class="word-count">
                                                <span id="word-count-cert">0</span> / 150 words
                                            </div>
                                        </div>
<div style="text-align: center;">
  <label for="skill" class="form-label">Select The Field You Would Like To Focus Your Professional Efforts On :</label>
    <select name="skill" id="skill" required>
        <option value="">-- Select a skill --</option>
        <option value="Criminal">Criminal</option>
        <option value="Plitical">Political</option>
        <option value="Family">Family</option>
        <option value="Finance">Finance</option>
        <option value="Education">Education</option>
        <option value="Civil">Civil</option>
    </select> </div> <br><br>

                                        <div class="mb-4">
                                            <label for="learn" class="form-label">Do you have an interest in going beyond the basics and learning more to elevate your career?</label>
                                            <textarea id="textarea" name="learn" class="form-control" placeholder="Describe your professional development goals and areas of law you're interested in expanding your knowledge..." rows="5" required></textarea>
                                            <div class="word-count">
                                                <span id="word-count-learn">0</span> / 150 words
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-2"></i>Submit & Continue
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {

                header("Location: login.php");

                exit();
                ob_end_flush();
            }
            ?>
        </div>
    </section>
    <!-- Application Content End -->

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
        // Function to count words in text
        function countWords(text) {
            return text.trim().split(/\s+/).filter(word => word.length > 0).length;
        }

        // Word count for certificates textarea
        const certificateTextarea = document.getElementById('area');
        const certificateWordCount = document.getElementById('word-count-cert');
        const maxWords = 150;

        if (certificateTextarea) {
            certificateTextarea.addEventListener('input', function() {
                let text = certificateTextarea.value;
                let wordCount = countWords(text);

                if (wordCount > maxWords) {
                    const trimmedText = text.split(/\s+/).slice(0, maxWords).join(' ');
                    certificateTextarea.value = trimmedText;
                    wordCount = maxWords;
                }

                certificateWordCount.textContent = wordCount;
            });
        }

        // Word count for learning textarea
        const learningTextarea = document.getElementById('textarea');
        const learningWordCount = document.getElementById('word-count-learn');

        if (learningTextarea) {
            learningTextarea.addEventListener('input', function() {
                let text = learningTextarea.value;
                let wordCount = countWords(text);

                if (wordCount > maxWords) {
                    const trimmedText = text.split(/\s+/).slice(0, maxWords).join(' ');
                    learningTextarea.value = trimmedText;
                    wordCount = maxWords;
                }

                learningWordCount.textContent = wordCount;
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