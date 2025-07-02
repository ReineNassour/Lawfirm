<?php
session_start();

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Client Contract</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- Google Fonts (same stack as admin pages) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet (shared colour palette / cards / tables) -->
    <link href="../css/admincss.css" rel="stylesheet">

    <!-- Small RTL tweaks for the contract body only -->
    <style>
        .contract-body     { direction: rtl; text-align: right; }
        .contract-body label,
        .contract-body input,
        .contract-body textarea,
        .contract-body ul  { direction: rtl; text-align: right; }
    </style>
</head>

<body>
<?php
include 'header.php';
include 'db.php';

/* --- data preparation exactly as before --- */
if (isset($_SESSION['attorney'])) {
    $attname  = $_SESSION['attorney']['fullName'];
    $attemail = $_SESSION['attorney']['email'];

    $sql2   = "SELECT * FROM user WHERE email='$attemail'";
    $res2   = $conn->query($sql2);
    $row2   = $res2->fetch_assoc();
    $address = $row2['address'];

    $id     = $_GET['id'];
    $row    = $conn->query("SELECT * FROM `case` WHERE id='$id'")->fetch_assoc();
    $caseid = $row['id'];
    $userID = $row['userid'];
    $caseimg= $row['caseContractimg'];

    $row1   = $conn->query("SELECT * FROM user WHERE id='$userID'")->fetch_assoc();
    $fname  = $row1['fname'];
    $lname  = $row1['lname'];
    $email  = $row1['email'];
?>
<div class="container py-5">
    <!-- Page Heading -->
    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center w-100">
                <i class="fas fa-file-contract text-primary mr-2"></i>
                Case Contract - <?= htmlspecialchars($fname." ".$lname) ?>
            </h2>
            <a href="payment.php?id=<?= $caseid ?>" class="btn btn-primary">
                <i class="fas fa-credit-card mr-1"></i> Payment
            </a>
        </div>
    </div>

    <!-- Contract Card -->
    <div class="card shadow-sm">
        <div class="card-body contract-body">
            <form method="post">
                <p><strong style="font-size:20px;">وكالة قانونية</strong></p>
                <p>أنا الموقع أدناه:</p>

                <div class="form-group">
                    <label>الاسم:</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($fname.' '.$lname) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>رقم الهوية:</label>
                    <input type="text" class="form-control" placeholder="[رقم الهوية]">
                </div>
                <div class="form-group">
                    <label>العنوان:</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($row1['address']) ?>" readonly>
                </div>

                <p class="mt-3">أوكل بموجب هذه الوثيقة:</p>

                <div class="form-group">
                    <label>الأستاذ/ة:</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($attname) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>عنوان المحامي:</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($address) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>رقم الهاتف:</label>
                    <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row2['phonenum']) ?>">
                </div>

                <p class="mt-3 mb-1">ليمارس النيابة عني في الآتي:</p>
                <ul>
                    <li>تقديم الدعاوى أو الدفاع عنها أمام المحاكم.</li>
                    <li>التوقيع على المستندات القانونية المتعلقة بالقضية.</li>
                    <li>التفاوض على تسويات أو اتفاقيات.</li>
                    <li>التوقيع على العقود باسم الموكل.</li>
                </ul>

                <div class="form-group">
                    <label>المدة:</label>
                    <input type="text" class="form-control" placeholder="[حدد المدة]">
                </div>

                <p class="mt-3">الشروط: لا يوجد شروط إضافية، وللمحامي اتخاذ الإجراءات القانونية اللازمة.</p>

                <div class="form-group">
                    <label>التوقيع– الاسم:</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($fname.' '.$lname) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>التاريخ:</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($row['startdate']) ?>" readonly>
                </div>

                <div class="text-center no-print">
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print mr-1"></i> Print Contract
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Upload Section -->
    <div class="card shadow-sm mt-5 no-print">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-upload mr-2 text-primary"></i> Contract
            </h5>
        </div>
        <?php
        $row7   = $conn->query("SELECT * FROM ccontract WHERE caseid='$caseid'")->fetch_assoc();
    $pimg  = $row7['paycontractimg'];
        ?>
        
        <?php
if($caseimg != 0 && $pimg != 0){

?>
        <div style="text-align: center;">
            <a href="PHcontract.php?id=<?= $caseid ; ?>" class="btn btn-primary" >view Signed Case Contract</a>&nbsp;&nbsp;&nbsp;
            <a href="SignPaycontract.php?id=<?= $caseid ; ?>" class="btn btn-primary" >view Signed Payment Contract</a>
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
                <input type="hidden" name="caseid" value="<?= $caseid ; ?>">
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

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
</body>
</html>
<?php } /* end session check */ ?>
