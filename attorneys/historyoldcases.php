<?php
session_start();
include 'header.php';
include 'db.php';

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
    <title>TheFirm – Session History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"    content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  rel="stylesheet">
    <link href="lib/animate/animate.min.css"                         rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css"        rel="stylesheet">

    <!-- Shared palette / cards -->
    <link href="../css/admincss.css" rel="stylesheet">

    <style>
        /* --- small local tweaks --- */
        .session-card                 {margin-bottom:1.5rem;}
        textarea#details              {min-height:120px;}
        .table thead th               {vertical-align:middle;}
        .table-hover tbody tr:hover   {background:#f8f9fa;}
        .badge-status                 {font-size:.8rem; padding:.35rem .6rem;}
        .table td, .table th {
            vertical-align: middle;
            word-break: break-word;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <br><br>
<?php
$caseid = $_GET['id'];
$sql1   = "SELECT * FROM `session` WHERE caseid='$caseid' ORDER BY id DESC";
$res1   = $conn->query($sql1);

if ($row1 = $res1->fetch_assoc()) {
    $sessionid = $row1['id'];
}
$sql2 = "SELECT * FROM `session` WHERE caseid='$caseid'";
$res2 = $conn->query($sql2);
?>
        
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-history mr-2 text-primary"></i>Session History</h5>
                <?php if ($res2->num_rows): ?>
                    <span class="badge badge-primary badge-status"><?= $res2->num_rows ?> Sessions</span>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Details</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$t = 0;
while ($row2 = $res2->fetch_assoc()):
    $t++;
    $sessionid = $row2['id'];

    $res3 = $conn->query("SELECT * FROM `history` WHERE sessionid='$sessionid'");
    while ($row3 = $res3->fetch_assoc()):
?>
                            <tr>
                                <td><?= $t; ?></td>
                                <td><?= htmlspecialchars($row3['content']); ?></td>
                                <td><?= htmlspecialchars($row2['date']); ?></td>
                            </tr>
<?php
    endwhile;
endwhile;

if (!$t):
?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">No session history found.</td>
                            </tr>
<?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>

   <?php include '../footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script>
        /* nav highlight */
        document.addEventListener('DOMContentLoaded', () => {
            const path = window.location.pathname;
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                if (path.includes(link.getAttribute('href'))) link.classList.add('active');
            });
        });
    </script>
</body>
</html>
