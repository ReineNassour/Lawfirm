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
    <title>TheFirm - Attorney CV</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Attorney CV, Legal Professional Profile" name="keywords">
    <meta content="View detailed attorney CV and professional profile" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/admincss.css" rel="stylesheet">

    <style>
        /* CV Page Specific Styling */
        .cv-profile-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 40px 0;
            border-radius: 12px;
            margin-bottom: 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .cv-profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto 20px;
        }

        .cv-profile-name {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .section-title {
            position: relative;
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background: #3498db;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .cv-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 40px;
        }

        .content-card {
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .content-card h4 {
            color: #3498db;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .content-card h4 i {
            margin-right: 10px;
            font-size: 22px;
        }

        .content-detail {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .cv-footer {
            text-align: center;
            margin: 30px 0;
        }

        .back-btn {
            background: #3498db;
            color: white;
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
            transition: all 0.3s ease;
            border: none;
        }

        .back-btn:hover {
            background: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }

        .empty-state {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .empty-state i {
            font-size: 30px;
            color: #bdc3c7;
            margin-bottom: 10px;
        }

        .badge-custom {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
            font-weight: 500;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 5px;
            display: inline-block;
        }

        @media (max-width: 767px) {
            .cv-profile-header {
                padding: 30px 0;
            }

            .cv-profile-image {
                width: 120px;
                height: 120px;
            }

            .cv-profile-name {
                font-size: 24px;
            }

            .section-title {
                font-size: 20px;
            }

            .cv-section {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php
    include 'header.php';
    $userid = $_GET['id'];
    $sql1 = "SELECT * FROM `cv` WHERE userid='$userid'";
    $res1 = $conn->query($sql1);
    $row1 = $res1->fetch_assoc();
    $cvid = $row1['id'];
    $univ = $row1['university'];
    $year = $row1['year'];
    $level = $row1['level'];
    $desc = $row1['description'];

    $sql = "SELECT * FROM `user` WHERE id='$userid'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $name = $fname . " " . $lname;
    $img = $row['image'];
    ?>

    <div class="container py-5">
        <!-- Profile Header -->
        <div class="cv-profile-header">
            <img src="../<?= $img; ?>" class="cv-profile-image" alt="<?= $name; ?>">
            <h1 class="cv-profile-name"><?= $name; ?></h1>
            <p class="text-muted">Attorney Professional Profile</p>
        </div>

        <!-- Educational History Section -->
        <div class="cv-section">
            <h2 class="section-title">Educational Background</h2>

            <div class="content-card">
                <h4><i class="fas fa-university"></i> University Education</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>University:</strong></p>
                        <div class="content-detail"><?= $univ; ?></div>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Graduation Year:</strong></p>
                        <div class="content-detail"><?= $year; ?></div>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h4><i class="fas fa-certificate"></i> Certifications & Qualifications</h4>
                <p><strong>Certification Level:</strong></p>
                <div class="content-detail"><?= nl2br($level); ?></div>
            </div>

            <div class="content-card">
                <h4><i class="fas fa-book-reader"></i> Career Development & Learning</h4>
                <p><strong>Professional Interests:</strong></p>
                <div class="content-detail"><?= nl2br($desc); ?></div>
            </div>
        </div>

        <!-- Case History Section -->
        <div class="cv-section">
            <h2 class="section-title">Case History</h2>

            <?php
            $sql2 = "SELECT * FROM `casewon` WHERE cvid='$cvid'";
            $res2 = $conn->query($sql2);
            $t1 = 0;

            if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_assoc()) {
                    $t1++;
                    $year = $row2['year'];
                    $nbofcases = $row2['nbofcases'];
                    $desc = $row2['description'];
            ?>
                    <div class="content-card">
                        <h4><i class="fas fa-gavel"></i> Case Experience #<?= $t1 ?></h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Number of Cases:</strong></p>
                                <div class="content-detail"><?= $nbofcases ?></div>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Year:</strong></p>
                                <div class="content-detail"><?= $year ?></div>
                            </div>
                        </div>
                        <p><strong>Case Description:</strong></p>
                        <div class="content-detail"><?= nl2br(htmlspecialchars($desc)) ?></div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p>No case history has been reported by this attorney.</p>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Languages Section -->
        <div class="cv-section">
            <h2 class="section-title">Language Proficiency</h2>

            <?php
            $sql3 = "SELECT * FROM `language` WHERE cvid='$cvid'";
            $res3 = $conn->query($sql3);
            $t2 = 0;

            if ($res3->num_rows > 0) {
            ?>
                <div class="row">
                    <?php
                    while ($row3 = $res3->fetch_assoc()) {
                        $t2++;
                        $lang = $row3['language'];
                        $level = $row3['level'];
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="content-card text-center h-100">
                                <h4><i class="fas fa-language"></i> <?= $lang ?></h4>
                                <span class="badge-custom"><?= $level ?></span>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div class="empty-state">
                    <i class="fas fa-comment-slash"></i>
                    <p>No language proficiencies have been reported by this attorney.</p>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Technical Skills Section -->
        <div class="cv-section">
            <h2 class="section-title">Technical Skills</h2>

            <?php
            $sql4 = "SELECT * FROM `techskills` WHERE cvid='$cvid'";
            $res4 = $conn->query($sql4);

            if ($res4->num_rows > 0) {
                while ($row4 = $res4->fetch_assoc()) {
                    $desc = $row4['description'];
                    $pew = $row4['p/e/w'];
            ?>
                    <div class="content-card">
                        <h4><i class="fas fa-laptop-code"></i> Software Proficiency</h4>
                        <div class="mb-3">
                            <p><strong>Microsoft Office Proficiency:</strong></p>
                            <div class="content-detail"><?= $pew ?></div>
                        </div>
                        <p><strong>Additional Software Skills:</strong></p>
                        <div class="content-detail"><?= $desc ?></div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="empty-state">
                    <i class="fas fa-desktop"></i>
                    <p>No technical skills have been reported by this attorney.</p>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Back Button -->
        <div class="cv-footer">
            <a href="applicants.php" class="back-btn">
                <i class="fas fa-arrow-left mr-2"></i> Back to Applicants
            </a>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- JavaScript Libraries -->
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