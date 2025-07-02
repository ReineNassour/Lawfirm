<?php 
session_start();

if (!isset($_SESSION['attorney'])) {
    header("Location: ../login.php");
    exit();
}
$id = $_SESSION['attorney']['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Case Management</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts – same stack used on the admin pages -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet – unified with the admin pages -->
    <link href="../css/admincss.css" rel="stylesheet"><!-- shared palette / cards / tables -->
    <link href="../css/attindex.css" rel="stylesheet"><!-- extra attorney-specific tweaks, kept as-is -->
</head>

<body>
    <?php include 'header.php'; ?>
    <!-- Main Content Start -->
    <div class="container py-5"><!-- matches “Accepted Applicants” spacing -->
        <h2 class="mb-4 text-center"><i class="fas fa-briefcase mr-2 text-primary"></i>Case Management Dashboard</h2>

        <?php
        include 'db.php';

        /*  (PHP messages left exactly the same)  */
        if (isset($_GET['acceptid']) && isset($_GET['nbb'])) {
            $nb = $_GET['nbb'];
            $acceptID = $_GET['acceptid'];

            if ($acceptID == 0)
                $sql1 = "UPDATE `case` SET status='Rejected' WHERE id='$nb'";
            else
                $sql1 = "UPDATE `case` SET status='Accepted' WHERE id='$nb'";

            if ($conn->query($sql1)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle mr-3"></i>
                            <strong>Success!</strong>&nbsp;Case status has been updated.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
        }
        ?>

        <!-- Status Cards -->
        <div class="row status-cards mb-5"><!-- added  h-100 & shadow-sm like admin page -->
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
                            $sql11 = "SELECT * FROM `case` WHERE status='Accepted' AND attid='$id'";
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

        <!-- Cases Table -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list-ul mr-2 text-primary"></i>All Cases</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <?php
                    $sql = "SELECT * FROM `case` WHERE attid='$id' AND status='Pending' ORDER BY startdate DESC";
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
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $TOT = 0;
                        while ($row = $result->fetch_assoc()) {
                            $catID  = $row['categoryid'];
                            $status = $row['status'];
                            $userID = $row['userid'];
                            $TOT++;

                            $res1 = $conn->query("SELECT * FROM user WHERE id = '$userID'");
                            $row1 = $res1->fetch_assoc();

                            $res3 = $conn->query("SELECT * FROM category WHERE id = '$catID'");
                            $row3 = $res3->fetch_assoc();
                        ?>
                            <tr>
                                <td><?= $TOT ?></td>
                                <td><?= $row1['fname'] . " " . $row1['lname'] ?></td>
                                <td><?= $row1['email'] ?></td>
                                <td><?= $row3['name'] ?></td>
                                <td><?= date('M d, Y', strtotime($row['startdate'])) ?></td>
                                <td class="case-description text-truncate" style="max-width:240px;" title="<?= htmlspecialchars($row['description']) ?>">
                                    <?= htmlspecialchars($row['description']) ?>
                                </td>
                                <td>
                                    <?php if ($status == 'Pending') { ?>
                                        <span class="badge bg-warning text-white px-3 py-2">
                                            <i class="fas fa-hourglass-half mr-1"></i>Pending
                                        </span>
                                    <?php } elseif ($status == 'Accepted') { ?>
                                        <span class="badge bg-success text-white px-3 py-2">
                                            <i class="fas fa-check mr-1"></i>Accepted
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger text-white px-3 py-2">
                                            <i class="fas fa-times mr-1"></i>Rejected
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                    <?php if ($status == 'Rejected') { ?>
                                        <a href="?acceptid=1&nbb=<?= $row['id'] ?>" class="btn btn-success">
                                            <i class="fas fa-check mr-1"></i>Accept
                                        </a>
                                    <?php } elseif ($status == 'Accepted') { ?>
                                        <a href="?acceptid=0&nbb=<?= $row['id'] ?>" class="btn btn-danger">
                                            <i class="fas fa-times mr-1"></i>Reject
                                        </a>
                                    <?php } else { ?>
                                        <a href="?acceptid=1&nbb=<?= $row['id'] ?>" class="btn btn-success">
                                            <i class="fas fa-check mr-1"></i>Accept
                                        </a>
                                        <a href="?acceptid=0&nbb=<?= $row['id'] ?>" class="btn btn-danger">
                                            <i class="fas fa-times mr-1"></i>Reject
                                        </a>
                                    <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- card -->
    </div><!-- /container -->
    <!-- Main Content End -->

    <!-- Footer -->
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

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template JS -->
    <script>
        // Enable tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        // CounterUp
        $('.counter').counterUp({ delay: 10, time: 1000 });
    </script>
</body>

</html>
