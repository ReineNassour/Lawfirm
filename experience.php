<?php
session_start();
include 'checkStatus.php';
include 'db.php';

// Handling form submission before HTML output
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['officeName']) && isset($_POST['nbOfYears'])) {
        $numOfExperiences = count($_POST['startDate']);
        for ($i = 0; $i < $numOfExperiences; $i++) {
            $startDate = $_POST['startDate'][$i];
            $endDate = $_POST['endDate'][$i];
            $officeName = mysqli_real_escape_string($conn, $_POST['officeName'][$i]);
            $nbOfYears = $_POST['nbOfYears'][$i];

            // Fetch the last inserted CV id
            $sql1 = "SELECT * FROM cv ORDER BY id DESC LIMIT 1";
            $res1 = $conn->query($sql1);
            $row1 = $res1->fetch_assoc();
            $cvid = $row1['id'];
            $desc = mysqli_real_escape_string($conn, $_POST['exp']);

            $sql = "INSERT INTO experience (startdate, enddate, officename, details, nbofyears, cvid) 
                    VALUES ('$startDate','$endDate','$officeName','$desc','$nbOfYears','$cvid')";
            $conn->query($sql);
        }

        header("Location: casewon.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Professional Experience</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Professional Experience" name="keywords">
    <meta content="Submit your professional experience details" name="description">

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

        /* Form Section Styles */
        .form-section {
            padding: 60px 0 90px;
        }

        .section-title {
            font-size: 36px;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: var(--primary);
            bottom: 0;
            left: 0;
        }

        .form-container {
            background-color: var(--white);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            border-radius: 5px;
        }

        .form-title {
            font-size: 24px;
            margin-bottom: 30px;
            color: var(--secondary-dark);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            height: 50px;
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid #e1e1e1;
            border-radius: 0;
            background-color: #ffffff;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: none;
        }

        textarea.form-control {
            height: auto;
            min-height: 150px;
        }

        .experience-entry {
            background-color: var(--light);
            padding: 25px;
            margin-bottom: 20px;
            border-left: 3px solid var(--primary);
            position: relative;
        }

        .experience-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .experience-col {
            flex: 1 0 calc(50% - 20px);
            padding: 0 10px;
            margin-bottom: 15px;
        }

        @media (max-width: 767.98px) {
            .experience-col {
                flex: 1 0 100%;
            }
        }

        .removeExperienceBtn {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--accent);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .removeExperienceBtn:hover {
            background-color: #8a2530;
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

        .btn-secondary {
            color: #fff;
            background-color: var(--secondary);
            border: none;
        }

        .btn-secondary::after {
            background-color: var(--secondary);
        }

        .btn-secondary::before {
            background-color: var(--primary);
        }

        .word-count {
            display: inline-block;
            font-size: 14px;
            color: var(--gray);
            margin-top: 5px;
        }

        .actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        @media (max-width: 575.98px) {
            .actions-row {
                flex-direction: column;
                gap: 15px;
            }

            .actions-row .btn {
                width: 100%;
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
                    <h2>Professional Experience</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="#">Experience</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Form Section Start -->
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="form-container">
                        <h2 class="section-title">About Your Experience</h2>
                        <p class="mb-4">Please provide details about your professional legal experience. This information will help us match you with appropriate cases and clients.</p>

                        <form id="experienceForm" method="POST" action="">
                            <div id="experienceContainer">
                                <!-- Dynamically added experience fields will appear here -->
                            </div>

                            <button type="button" id="addExperienceBtn" class="btn btn-secondary mt-3">
                                <i class="fas fa-plus me-2"></i>Add Another Experience
                            </button>

                            <div class="form-group mt-5">
                                <h3 class="form-title">Professional Summary</h3>
                                <p class="mb-3">Tell us more about your professional experiences, skills, and expertise.</p>
                                <textarea id="exp" name="exp" class="form-control" placeholder="Describe your professional background, notable cases, specialized areas, and other relevant information..." rows="5"></textarea>
                                <div class="word-count mt-2">
                                    <span id="current-word-count">0</span> / 150 words
                                </div>
                            </div>

                            <div class="actions-row">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Submit & Continue
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Form Section End -->

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
        // Function to add a new experience entry
        function addExperienceEntry() {
            const experienceContainer = document.getElementById('experienceContainer');

            const newExperienceDiv = document.createElement('div');
            newExperienceDiv.classList.add('experience-entry');

            newExperienceDiv.innerHTML = `
                <button type="button" class="removeExperienceBtn" title="Remove this entry">
                    <i class="fas fa-times"></i>
                </button>
                <div class="experience-row">
                    <div class="experience-col">
                        <label class="form-label" for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="startDate[]" required>
                    </div>
                    <div class="experience-col">
                        <label class="form-label" for="endDate">End Date</label>
                        <input type="date" class="form-control" name="endDate[]" required>
                    </div>
                </div>
                <div class="experience-row">
                    <div class="experience-col">
                        <label class="form-label" for="officeName">Office/Firm Name</label>
                        <input type="text" class="form-control" name="officeName[]" placeholder="Enter the office or firm name" required>
                    </div>
                    <div class="experience-col">
                        <label class="form-label" for="nbOfYears">Years of Experience</label>
                        <input type="number" class="form-control" name="nbOfYears[]" placeholder="Enter number of years" min="1" required>
                    </div>
                </div>
            `;

            experienceContainer.appendChild(newExperienceDiv);

            // Add event listener to the "Remove" button
            newExperienceDiv.querySelector('.removeExperienceBtn').addEventListener('click', function() {
                experienceContainer.removeChild(newExperienceDiv);
            });
        }

        // Add the first experience entry when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            addExperienceEntry();

            // Add a new experience entry when the "Add Another Experience" button is clicked
            document.getElementById('addExperienceBtn').addEventListener('click', addExperienceEntry);
        });

        // Word count functionality
        const textarea = document.getElementById('exp');
        const wordCountDisplay = document.getElementById('current-word-count');
        const maxWords = 150;

        // Function to count words in the textarea
        function countWords(text) {
            return text.trim().split(/\s+/).filter(word => word.length > 0).length;
        }

        // Event listener to monitor textarea input
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