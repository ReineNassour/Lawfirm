<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}

$id = $_SESSION['attorney']['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Cases Won</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts (same stack used in admin pages) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- In <head> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Before </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Template Stylesheet (shared palette / cards / tables) -->
    <link href="../css/admincss.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <!-- Page Heading -->
        <div class="container py-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-center w-100">
                    <i class="fas fa-trophy text-success mr-2"></i>Cases Won
                </h2>
            </div>
        </div>

        <!-- Status Card -->
        <div class="row status-cards mb-5">
            <div class="col-md-4 offset-md-4 mb-4"><!-- centered single card -->
                <div class="card status-card accepted-card h-100">
                    <a href="caseswon.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <h5 class="card-title">Cases Won</h5>
                            <?php
                            $sql11 = "SELECT * FROM `case` WHERE casestatus='Closed' AND attid='$id'";
                            $res11 = $conn->query($sql11);
                            $t11   = $res11->num_rows;
                            ?>
                            <p class="display-4"><?= $t11; ?></p>
                            <small>Successfully closed</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Status Card -->

        <!-- Old Cases Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-archive mr-2 text-primary"></i>Old Cases
                </h5>
                <span class="badge bg-success text-white px-3 py-2"><?= $t11 ?> Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <?php
                    $sql    = "SELECT * FROM `case` WHERE casestatus='Closed' AND attid='$id'";
                    $result = $conn->query($sql);
                    ?>
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Case Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Description</th>
                                <th>History</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $TOT = 0;
                            while ($row = $result->fetch_assoc()) {
                                $catID  = $row['categoryid'];
                                $userID = $row['userid'];
                                $caseid = $row['id'];
                                $TOT++;

                                $resUser = $conn->query("SELECT * FROM user WHERE id='$userID'");
                                $rowUser = $resUser->fetch_assoc();

                                $resCat  = $conn->query("SELECT * FROM category WHERE id='$catID'");
                                $rowCat  = $resCat->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?= $TOT ?></td>
                                    <td><?= htmlspecialchars($rowUser['fname'] . ' ' . $rowUser['lname']) ?></td>
                                    <td><?= htmlspecialchars($rowUser['email']) ?></td>
                                    <td><?= htmlspecialchars($rowCat['name']) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['startdate'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['enddate'])) ?></td>
                                    <!-- View Button -->
<td class="case-description">
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#descModal<?= $row['id'] ?>">
        View
    </button>

    <!-- Modal -->
    <div class="modal fade" id="descModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="descModalLabel<?= $row['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descModalLabel<?= $row['id'] ?>">Case Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= nl2br(htmlspecialchars($row['description'])) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</td>
<td>
     <a href="historyoldcases.php?id=<?= $caseid ; ?>" class="btn btn-primary btn-action">
                                                     History
                                                </a>
</td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Old Cases Table -->
    </div><!-- /container -->

    <!-- Footer (same footer style) -->
    <footer class="footer bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    &copy; 2025 TheFirm. All Rights Reserved.
                </div>
                <div class="col-md-6 text-center text-md-right">
                    Designed by <a href="#" class="text-white">LegalTech Solutions</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script>
        /* highlight current nav item + enable tooltips */
        document.addEventListener('DOMContentLoaded', () => {
            const path = window.location.pathname;
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                if (path.includes(link.getAttribute('href'))) link.classList.add('active');
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.case-description').tooltip();
        });
    </script>
</body>
</html>
