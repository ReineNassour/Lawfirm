<?php
session_start();
include 'header.php';

if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Report Won Cases</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Case Reporting" name="keywords">
    <meta content="Report your won legal cases for our records" name="description">

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
    <link href="css/casewon.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Report Won Cases</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="#">Report Cases</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Form Section Start -->
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="form-container">
                        <h2 class="section-title">Case History</h2>
                        <p class="mb-4">Please report your successfully won legal cases. This information helps us build a comprehensive profile of your expertise.</p>

                        <form id="experienceForm" method="POST" action="CvCases.php">
                            <div class="form-group">
                                <h3 class="form-title">Do you have any legal cases to report?</h3>
                                <div id="caseContainer">
                                    <!-- Case entries will appear here -->
                                </div>

                                <button type="button" id="addCaseBtn" class="btn btn-secondary mt-3">
                                    <i class="fas fa-plus me-2"></i>Add Another Case
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Form Section End -->

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
        function addCaseEntry() {
            const caseContainer = document.getElementById('caseContainer');
            const newCaseDiv = document.createElement('div');
            newCaseDiv.classList.add('case-entry', 'mb-4', 'p-3', 'border', 'rounded');

            newCaseDiv.innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Number of Cases</label>
                        <input type="number" name="numberOfCases[]" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year of the Case</label>
                        <input type="number" name="caseYear[]" class="form-control" min="1900" max="${new Date().getFullYear()}" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Case Description</label>
                        <textarea name="caseDescription[]" class="form-control" rows="3" placeholder="Brief description about the case..." required></textarea>
                    </div>
                </div>

                <button type="button" class="btn btn-danger removeCaseBtn">
                    <i class="fas fa-trash me-2"></i>Remove
                </button>
            `;

            caseContainer.appendChild(newCaseDiv);

            newCaseDiv.querySelector('.removeCaseBtn').addEventListener('click', function () {
                caseContainer.removeChild(newCaseDiv);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            addCaseEntry(); // Add initial case entry
            document.getElementById('addCaseBtn').addEventListener('click', addCaseEntry);
        });

        // Sticky Header
        $(window).scroll(function () {
            $('.header').toggleClass('sticky', $(this).scrollTop() > 100);
        });

        // Back to Top
        $(window).scroll(function () {
            $('.back-to-top').toggleClass('active', $(this).scrollTop() > 200);
        });

        $('.back-to-top').click(function () {
            $('html, body').animate({ scrollTop: 0 }, 800);
            return false;
        });
    </script>
</body>

</html>
