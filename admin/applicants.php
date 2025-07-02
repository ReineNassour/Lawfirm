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

    <link href="../css/admincss.css" rel="stylesheet">
</head>

<body>

    <?php
    include 'header.php';

    $sql = "SELECT * FROM cv where status='Pending'";
    $result = $conn->query($sql);
    ?>

    <div class="container py-5">
        <h2 class="page-title mb-4">Pending Applicants Management</h2>

        <div class="row status-cards mb-5">
            <div class="col-md-4 mb-4">
                <div class="card status-card pending-card h-100">
                    <a href="applicants.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5 class="card-title">Pending Applicants</h5>
                            <?php
                            $sql10 = "SELECT * FROM `cv` where status='Pending'";
                            $res10 = $conn->query($sql10);
                            $t10 = 0;
                            while ($row10 = $res10->fetch_assoc()) {
                                $t10++;
                            }
                            ?>
                            <p class="display-4"><?php echo $t10; ?></p>
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
                            <h5 class="card-title">Accepted Applicants</h5>
                            <?php
                            $sql11 = "SELECT * FROM `cv` 
          WHERE status='Accepted' 
          AND userid NOT IN (
              SELECT userid FROM `attorneys` 
              UNION 
              SELECT userid FROM `quizresult`
          )";
                            $res11 = $conn->query($sql11);
                            $t11 = 0;
                            while ($row11 = $res11->fetch_assoc()) {
                                $t11++;
                            }
                            ?>
                            <p class="display-4"><?php echo $t11; ?></p>
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
                            <h5 class="card-title">Rejected Applicants</h5>
                            <?php
                            $sql12 = "SELECT * FROM `cv` where status='Rejected'";
                            $res12 = $conn->query($sql12);
                            $t12 = 0;
                            while ($row12 = $res12->fetch_assoc()) {
                                $t12++;
                            }
                            ?>
                            <p class="display-4"><?php echo $t12; ?></p>
                            <small>Not proceeding</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-5">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-user-clock mr-2 text-primary"></i> Pending Applicants</h5>
                <span class="badge bg-warning text-white px-3 py-2" style="background-color: #f39c12;"><?= $t10 ?> Pending Applications</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Applicant</th>
                                <th>Contact</th>
                                <th>CV</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $t = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $t++;
                                    $id = $row['id'];
                                    $userid = $row['userid'];
                                    $sql1 = "SELECT * FROM user WHERE id='$userid'";
                                    $result1 = $conn->query($sql1);
                                    while ($row2 = $result1->fetch_assoc()) {
                                        $id = $row2['id'];
                                        $fname = $row2['fname'];
                                        $lname = $row2['lname'];
                                        $name = $fname . " " . $lname;
                                        $email = $row2['email'];
                            ?>
                                        <tr>
                                            <td><?= $t; ?></td>
                                            <td>
                                                <div class="applicant-info">
                                                    <div class="applicant-avatar">
                                                        <?= strtoupper(substr($fname, 0, 1) . substr($lname, 0, 1)); ?>
                                                    </div>
                                                    <div class="applicant-details">
                                                        <h6><?= $name; ?></h6>
                                                        <small>Applicant #<?= $id; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="contact-info">
                                                    <i class="fas fa-envelope text-secondary mr-2"></i> <?= $email; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="cv.php?id=<?= $id; ?>" class="btn btn-primary btn-action">
                                                    <i class="fas fa-file-contract mr-1"></i> View CV
                                                </a>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <!-- Accept Form -->
                                                    <form action="sendemailAccepted.php" method="post">
                                                        <?php $adname = $_SESSION['admin']['fullName']; ?>
                                                        <input type="hidden" name="adname" value="<?= $adname; ?>">
                                                        <input type="hidden" name="userid" value="<?= $row2['id']; ?>">
                                                        <input type="hidden" name="cvid" value="<?= $row['id']; ?>">
                                                        <input type="hidden" name="email" value="<?= $row2['email']; ?>">
                                                        <input type="hidden" name="name" value="<?= $name; ?>">
                                                        <button type="submit" class="btn btn-success btn-action">
                                                            <i class="fas fa-check mr-1"></i> Accept
                                                        </button>
                                                    </form>

                                                    <!-- Reject Form -->
                                                    <form action="sendemailRejected.php" method="post">
                                                        <?php $adname = $_SESSION['admin']['fullName']; ?>
                                                        <input type="hidden" name="adname" value="<?= $adname; ?>">
                                                        <input type="hidden" name="userid" value="<?= $row2['id']; ?>">
                                                        <input type="hidden" name="cvid" value="<?= $row['id']; ?>">
                                                        <input type="hidden" name="email" value="<?= $row2['email']; ?>">
                                                        <input type="hidden" name="name" value="<?= $name; ?>">
                                                        <button type="submit" class="btn btn-danger btn-action">
                                                            <i class="fas fa-times mr-1"></i> Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open text-muted" style="font-size: 48px;"></i>
                                            <p class="mt-3 mb-0">No pending applications found</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

    <!-- jQuery -->
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