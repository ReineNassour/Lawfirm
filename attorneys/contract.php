<?php
session_start();
include 'db.php';

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}

$id = $_GET['id'];

include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Payment</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts (unified) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Shared palette / cards -->
    <link href="../css/admincss.css" rel="stylesheet">
</head>

<body>
<?php
$row1   = $conn->query("SELECT * FROM `case` WHERE id='$id'")->fetch_assoc();
$userID = $row1['userid'];
 $caseimg= $row1['caseContractimg'];
$row2   = $conn->query("SELECT * FROM user WHERE id='$userID'")->fetch_assoc();

$row4   = $conn->query("SELECT * FROM ccontract WHERE caseid='$id'")->fetch_assoc();
$status = $row4['status'] ?? '';
?>

<div class="container py-5">
    <!-- Heading -->
    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center w-100">
                <i class="fas fa-file-invoice-dollar text-primary mr-2"></i>
                Payment Details
            </h2>
           
        </div>
    </div>

    <!-- Payment Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-hand-holding-usd mr-2 text-success"></i>
                <?= htmlspecialchars($row2['fname'].' '.$row2['lname']) ?>
            </h5>
            <?php if ($status): ?>
                <span class="badge <?= $status=='Accepted'?'bg-success':'bg-secondary' ?> text-white px-3 py-2">
                    <?= $status ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <p><?= htmlspecialchars($row1['description']) ?></p>

            <?php if ($status == 'Accepted'): ?>
                <!-- DISPLAY contract data -->
                <form method="post">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>Description</th>
                            <td><input type="text" name="desc" class="form-control"
                                       value="<?= htmlspecialchars($row4['description']) ?>" required></td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td><input type="number" name="bef" class="form-control"
                                       value="<?= htmlspecialchars($row4['total']) ?>" required></td>
                        </tr>
                        <tr>
                            <th>Number of Payments</th>
                            <td><input type="text" name="aft" class="form-control"
                                       value="<?= htmlspecialchars($row4['nbrofpay']) ?>" required></td>
                        </tr>
                    </table>

                    <div class="text-center mt-4">
                         <a href="accepted.php" class="btn btn-primary">
                             Back
                        </a>
                        <a href="paycontract.php?id=<?= $row4['id'] ?>" class="btn btn-primary">
                            <i class="fas fa-credit-card mr-1"></i> Payment Contract
                        </a>
                         
                    </div>
                </form>

            <?php else: ?>
                <!-- NEW contract -->
                <form method="post" action="payProcess.php">
                    <input type="hidden" name="caseid" value="<?= $id; ?>">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>Description</th>
                            <td><input type="text" name="desc" class="form-control" required></td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td><input type="number" name="total" class="form-control" required></td>
                        </tr>
                        <tr>
                            <th>Number of Payments</th>
                            <td><input type="text" name="nbrofpay" class="form-control" required></td>
                        </tr>
                    </table>

                    <div class="text-center mt-4">
                         <a href="accepted.php" class="btn btn-primary">
                             Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Submit
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <!-- /Payment Card -->
</div><!-- /container -->

<div class="card shadow-sm mt-5 no-print">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-upload mr-2 text-primary"></i> Contract
            </h5>
        </div>
        <?php
        $row7   = $conn->query("SELECT * FROM ccontract WHERE caseid='$id'")->fetch_assoc();
        if($row7) {
       
    $pimg  = $row7['paycontractimg'];
     } else {
            echo " ";
        }
        ?>
        
        <?php
if($caseimg != 0 && $pimg != 0){

?>
        <div style="text-align: center;">
            <a href="PHcontract.php?id=<?= $id ; ?>" class="btn btn-primary" >view Signed Case Contract</a>&nbsp;&nbsp;&nbsp;
            <a href="SignPaycontract.php?id=<?= $id ; ?>" class="btn btn-primary" >view Signed Payment Contract</a>
        </div>
        <?php
} else {
    ?>
    <div style="text-align: center;">
        <strong>Not Signed Yet</strong>
    </div>
    <?php
} ?>  
    </div>
    <!-- /Upload Section -->
</div><!-- /container -->

 <div class="card shadow-sm mt-5 no-print">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-upload mr-2 text-primary"></i>Upload &amp; Send Contract
            </h5>
        </div>
        <div class="card-body">
            <form action="Documents.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="mb-2"><i class="fas fa-file-upload mr-1"></i>اختر ملفد:</label>
                    <input type="file" name="uploadfile" class="form-control" required>
                </div>
                <input type="hidden" name="caseid" value="<?= $id ; ?>">
                <input type="hidden" name="userid" value="<?= $userID ; ?>">
                <input type="hidden" name="attid" value="<?= $_SESSION['attorney']['id'] ; ?>">
                <button type="submit" name="enter" class="btn btn-primary mt-3">
                    <i class="fas fa-paper-plane mr-1"></i> Send Documents
                </button>
                <a href="viewdocuments.php?id=<?= $caseid ; ?>" class="btn btn-primary mt-3">View Documents</a>
            </form>
        </div>
    </div>

    <br>

<!-- Footer (shared style) -->
<footer class="footer bg-dark text-white py-4 mt-5 no-print">
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

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    /* highlight nav + tooltips */
    document.addEventListener('DOMContentLoaded', () => {
        const path = window.location.pathname;
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            if (path.includes(link.getAttribute('href'))) link.classList.add('active');
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<!-- JS libs + nav highlight -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const path = window.location.pathname;
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            if (path.includes(link.getAttribute('href'))) link.classList.add('active');
        });
    });
</script>
</body>
</html>
