<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm - Applicant Management</title>
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
    <?php include 'header.php'; ?>
    <div class="container py-5">
        <div class="dashboard-header mb-5">
            <h1 class="text-center mb-3">Administration Dashboard</h1>
            <p class="text-center text-muted">Welcome back, <?php echo $_SESSION['admin']['fullName']; ?>. Here's an overview of TheFirm's current status.</p>
        </div>

        <div class="row status-cards mb-5">
            <!-- Total Users Card -->
            <div class="col-md-4 mb-4">
                <div class="card stat-card users-card h-100">
                    <div class="card-body text-center">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="stat-title">Total Users</h3>
                        <?php
                        $sql1 = "SELECT * FROM user where role=0";
                        $res1 = $conn->query($sql1);
                        $t1 = 0;
                        while ($row1 = $res1->fetch_assoc()) {
                            $t1++;
                        }
                        ?>
                        <p class="card-text display-4"><?php echo $t1; ?></p>
                        <a href="users.php" class="btn btn-outline-primary btn-sm mt-3">
                            <i class="fas fa-arrow-right mr-1"></i> View All Users
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Attorneys Card -->
            <div class="col-md-4 mb-4">
                <div class="card stat-card attorneys-card h-100">
                    <div class="card-body text-center">
                        <div class="stat-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="stat-title">Total Attorneys</h3>
                        <?php
                        $sql2 = "SELECT * FROM attorneys";
                        $res2 = $conn->query($sql2);
                        $t2 = 0;
                        while ($row2 = $res2->fetch_assoc()) {
                            $t2++;
                        }
                        ?>
                        <p class="card-text display-4"><?php echo $t2; ?></p>
                        <a href="passedlawyers.php" class="btn btn-outline-primary btn-sm mt-3">
                            <i class="fas fa-arrow-right mr-1"></i> View All Attorneys
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Applicants Card -->
            <div class="col-md-4 mb-4">
                <div class="card stat-card applicants-card h-100">
                    <div class="card-body text-center">
                        <div class="stat-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <h3 class="stat-title">Pending Applicants</h3>
                        <?php
                        $sql5 = "SELECT * FROM `cv` where status='Pending'";
                        $res5 = $conn->query($sql5);
                        $t5 = 0;
                        while ($row5 = $res5->fetch_assoc()) {
                            $t5++;
                        }
                        ?>
                        <p class="card-text display-4"><?php echo $t5; ?></p>
                        <a href="applicants.php" class="btn btn-outline-primary btn-sm mt-3">
                            <i class="fas fa-arrow-right mr-1"></i> Review Applicants
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="section-title mb-4">Case Management</h4>

       <div class="row status-cards mb-5">

    <!-- Total Accepted Cases Card -->
    <div class="col-md-4 mb-4">
        <div class="card stat-card accepted-card h-100 bg-success text-white">
            <div class="card-body text-center">
                <div class="stat-icon mb-2" style="font-size: 1.8rem;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="stat-title">Accepted Cases</h3>
                <?php
                $sql4 = "SELECT * FROM `case` where status='Accepted'";
                $res4 = $conn->query($sql4);
                $t4 = $res4->num_rows;
                ?>
                <p class="card-text display-4"><?php echo $t4; ?></p>
                <a href="acceptedcases.php" class="btn btn-outline-light btn-sm mt-3">
                    <i class="fas fa-arrow-right mr-1"></i> View Accepted Cases
                </a>
            </div>
        </div>
    </div>

    <!-- Total Pending Cases Card -->
    <div class="col-md-4 mb-4">
        <div class="card stat-card pending-card h-100 bg-warning text-white">
            <div class="card-body text-center">
                <div class="stat-icon mb-2" style="font-size: 1.8rem;">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="stat-title">Pending Cases</h3>
                <?php
                $sql3 = "SELECT * FROM `case` where status='Pending'";
                $res3 = $conn->query($sql3);
                $t3 = $res3->num_rows;
                ?>
                <p class="card-text display-4"><?php echo $t3; ?></p>
                <a href="pendingcases.php" class="btn btn-outline-light btn-sm mt-3">
                    <i class="fas fa-arrow-right mr-1"></i> View Pending Cases
                </a>
            </div>
        </div>
    </div>

    <!-- Total Rejected Cases Card -->
    <div class="col-md-4 mb-4">
        <div class="card stat-card rejected-card h-100 bg-danger text-white">
            <div class="card-body text-center">
                <div class="stat-icon mb-2" style="font-size: 1.8rem;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3 class="stat-title">Rejected Cases</h3>
                <?php
                $sql3 = "SELECT * FROM `case` where status='Rejected'";
                $res3 = $conn->query($sql3);
                $t3 = $res3->num_rows;
                ?>
                <p class="card-text display-4"><?php echo $t3; ?></p>
                <a href="rejectedcases.php" class="btn btn-outline-light btn-sm mt-3">
                    <i class="fas fa-arrow-right mr-1"></i> View Rejected Cases
                </a>
            </div>
        </div>
    </div>

</div>

        <!-- Quick Links Section -->
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-4">Quick Actions</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3 text-center">
                        <a href="applicants.php" class="btn btn-outline-primary btn-lg w-100">
                            <i class="fas fa-user-clock mb-2 d-block" style="font-size: 24px;"></i>
                            Review Applicants
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3 text-center">
                        <a href="cases.php" class="btn btn-outline-primary btn-lg w-100">
                            <i class="fas fa-gavel mb-2 d-block" style="font-size: 24px;"></i>
                            Manage Cases
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3 text-center">
                        <a href="passedlawyers.php" class="btn btn-outline-primary btn-lg w-100">
                            <i class="fas fa-user-tie mb-2 d-block" style="font-size: 24px;"></i>
                            Attorney Directory
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3 text-center">
                        <a href="reports.php" class="btn btn-outline-primary btn-lg w-100">
                            <i class="fas fa-chart-bar mb-2 d-block" style="font-size: 24px;"></i>
                            Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Extra Scripts -->
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Add active class to current page nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                if (currentLocation.includes(link.getAttribute('href'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>