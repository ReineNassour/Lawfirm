<?php
session_start();
include '../db.php';

if (!isset($_SESSION['manager'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Passed Lawyers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Attorney Management" name="keywords">
    <meta content="Attorney Management System for Law Firms" name="description">

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
    <?php include 'headerM.php'; ?>

    <div class="container py-5">
        <div class="page-header-3 mb-5">
            <h1 class="text-center mb-3">Passed Lawyers</h1>
            <p class="text-center text-muted">Qualified legal professionals who have successfully completed our evaluation process</p>
        </div>

        <div class="row">
            <?php
            $sql = "SELECT * FROM user WHERE role=2";
            $res = $conn->query($sql);

            if ($res && $res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $id = $row['id'];

                    $sql1 = "SELECT * FROM attorneys WHERE userid='$id'";
                    $res1 = $conn->query($sql1);
                    $specializationText = "";
                    if ($res1 && $res1->num_rows > 0) {
                        $row1 = $res1->fetch_assoc();
                        $specializationText = $row1['specialized'];
                    }

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
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card lawyer-card h-100">
                            <div class="lawyer-image">
                                <img src="../<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?>" class="img-fluid">
                                <?php if (!empty($specializationText)) { ?>
                                    <div class="specialization-badge">
                                        <?= htmlspecialchars($specializationText); ?> Law
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body lawyer-info">
                                <h3><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></h3>

                                <div class="lawyer-meta">
                                    <?php if (!empty($graduationYear)) { ?>
                                        <div class="lawyer-meta-item">
                                            <i class="fas fa-graduation-cap"></i>
                                            <span>Graduated <?= htmlspecialchars($graduationYear); ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($university)) { ?>
                                        <div class="lawyer-meta-item">
                                            <i class="fas fa-university"></i>
                                            <span><?= htmlspecialchars($university); ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="lawyer-meta-item">
                                        <i class="fas fa-envelope"></i>
                                        <span><?= htmlspecialchars(strtolower($row['fname'] . '.' . $row['lname'])); ?>@thefirm.com</span>
                                    </div>
                                </div>

                                <div class="lawyer-actions mt-3">
                                    <button class="btn btn-info btn-sm view-details" data-bs-toggle="modal" data-bs-target="#lawyerModal<?= $id; ?>">
                                        <i class="fas fa-info-circle me-1"></i> View Details
                                    </button>
                                    <a href="attcontract.php?id=<?= $id; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-file-contract me-1"></i> View Contract
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lawyer Modal -->
                    <div class="modal fade" id="lawyerModal<?= $id; ?>" tabindex="-1" aria-labelledby="lawyerModalLabel<?= $id; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lawyerModalLabel<?= $id; ?>">
                                        <?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?>
                                        <?php if (!empty($specializationText)) { ?>
                                            <span class="badge bg-primary ms-2"><?= htmlspecialchars($specializationText); ?> Law</span>
                                        <?php } ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-4 mb-md-0">
                                            <img src="../<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?>" class="img-fluid rounded shadow-sm">

                                            <div class="contact-info mt-4">
                                                <h6 class="section-title">Contact Information</h6>
                                                <ul class="list-unstyled">
                                                    <li class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-envelope text-primary me-2"></i>
                                                        <span><?= htmlspecialchars(strtolower($row['fname'] . '.' . $row['lname'])); ?>@thefirm.com</span>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-phone text-primary me-2"></i>
                                                        <span>(123) 456-7890</span>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                        <span>Main Office</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="section-title">Professional Profile</h6>
                                            <?php if (!empty($description)) { ?>
                                                <p><?= nl2br(htmlspecialchars($description)); ?></p>
                                            <?php } else { ?>
                                                <p><?= htmlspecialchars($row['fname']); ?> is a qualified legal professional who has successfully completed our evaluation process.
                                                    <?php if (!empty($specializationText)) { ?>
                                                        With specialized knowledge in <?= htmlspecialchars($specializationText); ?> Law,
                                                    <?php } ?>
                                                    they bring expertise and dedication to client cases.</p>
                                            <?php } ?>

                                            <?php if (!empty($university) || !empty($graduationYear)) { ?>
                                                <h6 class="section-title mt-4">Education</h6>
                                                <ul class="list-unstyled">
                                                    <?php if (!empty($university)) { ?>
                                                        <li class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-university text-primary me-2"></i>
                                                            <span><?= htmlspecialchars($university); ?></span>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if (!empty($graduationYear)) { ?>
                                                        <li class="d-flex align-items-center">
                                                            <i class="fas fa-graduation-cap text-primary me-2"></i>
                                                            <span>Class of <?= htmlspecialchars($graduationYear); ?></span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>

                                            <h6 class="section-title mt-4">Practice Areas</h6>
                                            <div class="practice-areas">
                                                <?php if (!empty($specializationText)) { ?>
                                                    <span class="badge rounded-pill bg-primary me-2 mb-2"><?= htmlspecialchars($specializationText); ?> Law</span>
                                                <?php } else { ?>
                                                    <span class="badge rounded-pill bg-primary me-2 mb-2">General Practice</span>
                                                <?php } ?>
                                                <span class="badge rounded-pill bg-secondary me-2 mb-2">Legal Consultation</span>
                                                <span class="badge rounded-pill bg-secondary me-2 mb-2">Case Management</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-user-tie"></i>
                        <h4>No Passed Lawyers Found</h4>
                        <p>There are currently no lawyers who have passed the evaluation process.</p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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