<?php
session_start();

if (!isset($_SESSION['attorney'])) {
    header("Location: ../login.php");
    exit();
}
$id = $_SESSION['attorney']['id'];
include 'db.php';
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
        <form action="accall.php" method="post">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-double mr-2"></i>Accept All
            </button>
        </form>
    </div>

    <div class="row status-cards mb-5">
        <div class="col-md-4 mb-4">
            <div class="card status-card pending-card h-100 shadow-sm">
                <a href="pending.php" class="stretched-link text-decoration-none text-reset">
                    <div class="card-body text-center">
                        <div class="status-icon">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                        <h5 class="card-title">Pending Cases</h5>
                        <?php
                        $sql10 = "SELECT * FROM `case` WHERE status='Pending' AND attid='$id'";
                        $res10 = $conn->query($sql10);
                        $t10 = $res10->num_rows;
                        ?>
                        <p class="display-4"><?php echo $t10; ?></p>
                        <small>Awaiting review</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card status-card accepted-card h-100 shadow-sm">
                <a href="accepted.php" class="stretched-link text-decoration-none text-reset">
                    <div class="card-body text-center">
                        <div class="status-icon">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <h5 class="card-title">Accepted Cases</h5>
                        <?php
                        $sql11 = "SELECT * FROM `case` WHERE status='Accepted' AND attid='$id' AND casestatus='Pending'";
                        $res11 = $conn->query($sql11);
                        $t11 = $res11->num_rows;
                        ?>
                        <p class="display-4"><?php echo $t11; ?></p>
                        <small>Currently active</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card status-card rejected-card h-100 shadow-sm">
                <a href="rejected.php" class="stretched-link text-decoration-none text-reset">
                    <div class="card-body text-center">
                        <div class="status-icon">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                        <h5 class="card-title">Rejected Cases</h5>
                        <?php
                        $sql12 = "SELECT * FROM `case` WHERE status='Rejected' AND attid='$id'";
                        $res12 = $conn->query($sql12);
                        $t12 = $res12->num_rows;
                        ?>
                        <p class="display-4"><?php echo $t12; ?></p>
                        <small>Not proceeding</small>
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
                        $sql = "SELECT * FROM `case` WHERE attid='$id' AND status='Pending' ORDER BY startdate DESC";
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
                                <td><?= $email ?></td>
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
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <form action="sendemailAccepted.php" method="post" class="d-inline">
                                        <input type="hidden" name="caseid" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="email" value="<?= $email ?>">
                                        <input type="hidden" name="name" value="<?= $clientName ?>">
                                        <input type="hidden" name="attname" value="<?= $_SESSION['attorney']['fullName'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>
                                    <form action="sendemailRejected.php" method="post" class="d-inline">
                                        <input type="hidden" name="caseid" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="email" value="<?= $email ?>">
                                        <input type="hidden" name="name" value="<?= $clientName ?>">
                                        <input type="hidden" name="attname" value="<?= $_SESSION['attorney']['fullName'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
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
