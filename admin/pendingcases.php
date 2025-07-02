<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Pending Cases</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../css/admincss.css" rel="stylesheet">
    <link href="../css/attindex.css" rel="stylesheet">
</head>

<body>
<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center w-100"><i class="fas fa-briefcase text-primary mr-2"></i>Pending Cases</h2>
    </div>

   <div class="row status-cards mb-5 justify-content-center">
    <div class="col-md-4 mb-4">
        <div class="card status-card pending-card h-100 shadow-sm text-center">
            <a href="dashboard.php" class="stretched-link text-decoration-none text-reset">
                <div class="card-body p-3">
                    <div class="status-icon mb-2" style="font-size: 1.8rem;">
                        <i class="fas fa-clock text-warning"></i>
                    </div>
                    <h5 class="card-title mb-1">Pending Cases</h5>
                    <?php
                    $sql10 = "SELECT * FROM `case` WHERE status='Pending'";
                    $res10 = $conn->query($sql10);
                    $t10 = $res10->num_rows;
                    ?>
                    <p class="h4 font-weight-bold mb-1"><?php echo $t10; ?></p>
                    <small class="text-muted">Awaiting review</small>
                </div>
            </a>
        </div>
    </div>  
</div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list-ul mr-2 text-primary"></i>All Pending Cases</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Case Type</th>
                            <th>Date</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `case` WHERE status='Pending' ORDER BY startdate DESC";
                        $result = $conn->query($sql);
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            $userid = $row['userid'];
                            $sqlUser = "SELECT * FROM user WHERE id = '$userid'";
                            $userResult = $conn->query($sqlUser)->fetch_assoc();
                            $clientName = $userResult['fname'] . ' ' . $userResult['lname'];
                            $email = $userResult['email'];

                            $catid = $row['categoryid'];
                            $category = $conn->query("SELECT name FROM category WHERE id = '$catid'")->fetch_assoc()['name'];
                            ?>
                            <tr>
                                <td><?= $counter++ ?></td>
                                <td><?= $clientName ?></td>
                               
                                <td><?= $category ?></td>
                                <td><?= date('M d, Y', strtotime($row['startdate'])) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#descModal<?= $row['id'] ?>">View</button>
                                    <div class="modal fade" id="descModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="descLabel<?= $row['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="descLabel<?= $row['id'] ?>">Case Description</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= htmlspecialchars($row['description']) ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="footer bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0">&copy; 2025 TheFirm. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <p class="m-0">Designed by <a href="#" class="text-white">LegalTech Solutions</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
</body>

</html>
