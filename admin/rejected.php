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
    <title>TheFirm – Rejected Applicant Management</title>
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

<?php
$sql = "SELECT * FROM cv WHERE status='Rejected'";
$result = $conn->query($sql);
?>

<div class="container py-5">
    <h2 class="mb-4 text-center">Rejected Applicants Management</h2>

    <!-- Status cards -->
    <div class="row status-cards mb-5">
        <!-- Pending -->
        <div class="col-md-4 mb-4">
            <div class="card status-card pending-card h-100">
                <a href="applicants.php">
                    <div class="card-body text-center">
                        <div class="status-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="card-title">Pending Applicants</h5>
                        <?php
                        $sql10 = "SELECT * FROM `cv` WHERE status='Pending'";
                        $res10 = $conn->query($sql10);
                        $t10  = 0;
                        while ($row10 = $res10->fetch_assoc()) { $t10++; }
                        ?>
                        <p class="display-4"><?= $t10; ?></p>
                        <small>Awaiting review</small>
                    </div>
                </a>
            </div>
        </div>

        <!-- Accepted -->
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

        <!-- Rejected -->
        <div class="col-md-4 mb-4">
            <div class="card status-card rejected-card h-100">
                <a href="rejected.php">
                    <div class="card-body text-center">
                        <div class="status-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h5 class="card-title">Rejected Applicants</h5>
                        <?php
                        $sql12 = "SELECT * FROM `cv` WHERE status='Rejected'";
                        $res12 = $conn->query($sql12);
                        $t12  = 0;
                        while ($row12 = $res12->fetch_assoc()) { $t12++; }
                        ?>
                        <p class="display-4"><?= $t12; ?></p>
                        <small>Not proceeding</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /Status cards -->

    <!-- Applicants table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-user-times mr-2 text-danger"></i> Rejected Applicants
            </h5>
             <input type="text" id="searchInput" placeholder="Search By Name ..." style="width: 280px; max-width:500px; height:45px;">
   
<script>
document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const clientName = row.cells[1]?.textContent.toLowerCase() || '';
        const caseType = row.cells[2]?.textContent.toLowerCase() || '';
        const description = row.cells[4]?.textContent.toLowerCase() || '';

        const match = clientName.includes(query) || caseType.includes(query) || description.includes(query);
        row.style.display = match ? '' : 'none';
    });
});
</script>
            <span class="badge bg-danger text-white px-3 py-2"><?= $t12 ?> Total</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>View CV</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php
                    $t = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $t++;
                            $id     = $row['id'];
                            $userid = $row['userid'];

                            $sql1   = "SELECT * FROM user WHERE id='$userid'";
                            $result1 = $conn->query($sql1);

                            while ($row2 = $result1->fetch_assoc()) {
                                $id    = $row2['id'];
                                $fname = $row2['fname'];
                                $lname = $row2['lname'];
                                $name  = $fname . " " . $lname;
                                $email = $row2['email'];
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $t; ?></td>

                            <!-- Avatar + name -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar mr-3"
                                         style="background:#e74c3c;color:#fff;width:40px;height:40px;
                                                border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                        <?= strtoupper(substr($fname,0,1).substr($lname,0,1)); ?>
                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?= $name; ?></h6>
                                        <small class="text-muted"><?= $email; ?></small>
                                    </div>
                                </div>
                            </td>

                            <td class="d-none"><?= $email; ?></td> <!-- kept for search/filter if needed -->

                            <td>
                                <a href="cv.php?id=<?= $id; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-contract mr-1"></i> CV
                                </a>
                            </td>

                            <td>
                                <form action="sendemailAccepted.php" method="post" class="d-inline">
                                    <?php $adname = $_SESSION['admin']['fullName']; ?>
                                    <input type="hidden" name="adname" value="<?= $adname; ?>">
                                    <input type="hidden" name="userid" value="<?= $row2['id']; ?>">
                                    <input type="hidden" name="cvid"   value="<?= $row['id']; ?>">
                                    <input type="hidden" name="email"  value="<?= $row2['email']; ?>">
                                    <input type="hidden" name="name"   value="<?= $name; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check mr-1"></i> Accept
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- /Applicants table -->
</div> <!-- /container -->

<?php include 'footer.php'; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /* highlight current nav item */
    document.addEventListener('DOMContentLoaded', () => {
        const path   = window.location.pathname;
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            if (path.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });
    });
</script>
</body>
</html>
