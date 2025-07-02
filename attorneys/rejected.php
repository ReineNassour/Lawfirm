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
    <title>TheFirm – Rejected Cases</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/admincss.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
         <div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center w-100"><i class="fas fa-briefcase text-primary mr-2"></i>Rejected Cases</h2>
         
    </div>

        <!-- Status cards -->
        <div class="row status-cards mb-5">
            <div class="col-md-4 mb-4">
                <div class="card status-card pending-card h-100">
                    <a href="pending.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5 class="card-title">Pending Cases</h5>
                            <?php
                            $sql10 = "SELECT * FROM `case` where status='Pending'  AND attid='$id' ORDER BY startdate DESC";
                            $res10 = $conn->query($sql10);
                            $t10 = 0;
                            while ($row10 = $res10->fetch_assoc()) {
                                $t10++;
                            }
                            ?>
                            <p class="display-4"><?= $t10; ?></p>
                            <small>Awaiting review</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card status-card accepted-card h-100">
                    <a href="accepted.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="card-title">Accepted Cases</h5>
                            <?php
                            $sql11 = "SELECT * FROM `case` where status='Accepted'  AND casestatus='Pending' AND attid='$id'";
                            $res11 = $conn->query($sql11);
                            $t11 = 0;
                            while ($row11 = $res11->fetch_assoc()) {
                                $t11++;
                            }
                            ?>
                            <p class="display-4"><?= $t11; ?></p>
                            <small>Currently active</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card status-card rejected-card h-100">
                    <a href="rejected.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h5 class="card-title">Rejected Cases</h5>
                            <?php
                            $sql12 = "SELECT * FROM `case` where status='Rejected' AND attid='$id'";
                            $res12 = $conn->query($sql12);
                            $t12 = 0;
                            while ($row12 = $res12->fetch_assoc()) {
                                $t12++;
                            }
                            ?>
                            <p class="display-4"><?= $t12; ?></p>
                            <small>Not proceeding</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Status cards -->

        <!-- Cases Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-user-times mr-2 text-danger"></i> Rejected Cases
                </h5>
                <span class="badge bg-danger text-white px-3 py-2"><?= $t12 ?> Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <?php
                    $sql = "SELECT * FROM `case` where status='Rejected' AND attid='$id'";
                    $result = $conn->query($sql);
                    ?>
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Case Type</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $TOT = 0;
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['categoryid'];
                                $userid = $row['userid'];
                                $TOT++;

                                $sqlUser = "SELECT * FROM user WHERE id = '$userid'";
                                $resUser = $conn->query($sqlUser);
                                $rowUser = $resUser->fetch_assoc();

                                $sqlCat = "SELECT * FROM category WHERE id = '$id'";
                                $resCat = $conn->query($sqlCat);
                                $rowCat = $resCat->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?= $TOT ?></td>
                                    <td><?= htmlspecialchars($rowUser['fname'] . " " . $rowUser['lname']) ?></td>
                                    <td><?= htmlspecialchars($rowUser['email']) ?></td>
                                    <td><?= htmlspecialchars($rowCat['name']) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['startdate'])) ?></td>
                                    <td class="case-description" title="<?= htmlspecialchars($row['description']) ?>"><?= htmlspecialchars($row['description']) ?></td>
                                    <td>
                                        <span class="status-badge status-rejected">
                                            <i class="fas fa-times mr-1"></i> Rejected
                                        </span>
                                    </td>
                                    <td>
                                        <a href="rejectCase.php?acceptid=1&nbb=<?= $row['id'] ?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-check mr-1"></i> Accept
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Cases Table -->
    </div> <!-- /container -->


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* highlight current nav item */
        document.addEventListener('DOMContentLoaded', () => {
            const path = window.location.pathname;
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                if (path.includes(link.getAttribute('href'))) {
                    link.classList.add('active');
                }
            });

            // Enable tooltips for description
            $('[data-toggle="tooltip"]').tooltip();
            $('.case-description').tooltip();
        });
    </script>
</body>

</html>
