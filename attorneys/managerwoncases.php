<?php
session_start();
include 'db.php';
include 'headerM.php';

if (!isset($_SESSION['manager'])) {
    header('location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Cases Won</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"    content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts (shared stack) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"  rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css"                   rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css"   rel="stylesheet">

    <!-- Shared palette / tables / cards -->
    <link href="../css/admincss.css" rel="stylesheet">

    <!-- OPTIONAL – Chart JS (kept because it was referenced) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ---------- page-specific tweaks ---------- */
        .dashboard-title        { font-weight:600; margin-top:30px; }
        .status-card            { border-left:5px solid #28a745; transition:transform .2s }
        .status-card:hover      { transform:scale(1.02) }
        .status-icon            { font-size:2.5rem;margin-bottom:10px }
        .card-header h5         { font-weight:600 }
        .case-description       { max-width:220px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis }
        .table th,.table td     { vertical-align:middle }
    </style>
</head>

<body>
<div class="wrapper">
    <div class="container py-2">

        <div class="container py-2">
            <h2 class="text-center dashboard-title">
                <i class="fas fa-trophy text-success mr-2"></i>Cases Won
            </h2>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-4 mb-4">
                <div class="card status-card shadow-sm text-center">
                    <a href="caseswon.php" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="status-icon text-success"><i class="fas fa-check-circle"></i></div>
                            <h5 class="card-title">Cases Won</h5>
                            <?php
                            $sql11 = "SELECT * FROM `case` WHERE casestatus='Won'";
                            $res11 = $conn->query($sql11);
                            $t11   = ($res11 ? $res11->num_rows : 0);
                            ?>
                            <p class="display-4 font-weight-bold"><?= $t11 ?></p>
                            <small class="text-muted">Successfully closed</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-archive mr-2 text-primary"></i>Cases Won</h5>
                <span class="badge bg-success text-white px-3 py-2"><?= $t11 ?> Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <?php
                    $sql    = "SELECT * FROM `case` WHERE casestatus='Won'";
                    $result = $conn->query($sql);
                    ?>
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Email</th>
                                <th>Case Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $TOT = 0;
                            while ($row = $result->fetch_assoc()) {
                                $TOT++;
                                $catID  = $row['categoryid'];
                                $userID = $row['userid'];

                                $rowUser = $conn->query("SELECT * FROM user WHERE id='$userID'")->fetch_assoc();
                                $rowCat  = $conn->query("SELECT * FROM category WHERE id='$catID'")->fetch_assoc();
                            ?>
                                <tr>
                                    <td><?= $TOT ?></td>
                                    <td><?= htmlspecialchars($rowUser['fname'].' '.$rowUser['lname']) ?></td>
                                    <td><?= htmlspecialchars($rowUser['email']) ?></td>
                                    <td><?= htmlspecialchars($rowCat['name']) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['startdate'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['enddate'])) ?></td>
                                    <td class="case-description" title="<?= htmlspecialchars($row['description']) ?>">
                                        <?= htmlspecialchars($row['description']) ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /card -->

    </div><!-- /container -->

    <!-- ===== Footer ===== -->
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
</div><!-- /wrapper -->

<!-- ===== JS ===== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script>
    /* nav highlight + tooltips */
    document.addEventListener('DOMContentLoaded',()=>{
        const path=window.location.pathname;
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link=>{
            if(path.includes(link.getAttribute('href'))) link.classList.add('active');
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('.case-description').tooltip();
    });
</script>
</body>
</html>
