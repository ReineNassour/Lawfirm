<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cashier'])) {
    header('location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TheFirm – Payment Contract</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"    content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon & Google Fonts (same across all pages) -->
    <link rel="icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS / Icon libs -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Shared theme sheet -->
    <link rel="stylesheet" href="../css/admincss.css">
    <!-- Your original extras -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/payment.css">

    <!-- Page-local tweaks to match dashboard style -->
    <style>
        /* -------- base -------- */
        body{font-family:'Poppins',sans-serif;background:#f8f9fa;}

        /* wrapper & title */
        .page-wrapper{padding:3rem 0;}
        .section-title{
            font-size:2rem;font-weight:600;text-align:center;color:#2c3e50;
            margin-bottom:2.5rem;position:relative;padding-bottom:15px;
        }
        .section-title:after{
            content:'';position:absolute;left:50%;bottom:0;transform:translateX(-50%);
            width:80px;height:4px;border-radius:2px;background:linear-gradient(to right,#007bff,#00c6ff);
        }

        /* payment “card” */
        .payment-card{
            background:#fff;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,.08);
            padding:2rem;margin-bottom:2rem;
        }
        .payment-header{
            font-weight:600;font-size:1.25rem;margin-bottom:1.5rem;color:#007bff;
        }
        .payment-table th{width:140px;color:#495057;font-weight:500;}
        .payment-table th,.payment-table td{padding:.75rem .5rem;font-size:.95rem;}
        .payment-table input{width:100%;border:1px solid #ced4da;border-radius:8px;padding:.45rem .75rem;}

        /* action buttons */
        .btn-gradient{
            background:linear-gradient(45deg,#007bff,#00c6ff);border:none;color:#fff;
            text-transform:uppercase;font-weight:500;border-radius:8px;padding:.45rem 1.25rem;
            transition:.3s;font-size:.9rem;
        }
        .btn-gradient:hover{background:linear-gradient(45deg,#0056b3,#007bff);}

        /* “Back” button matches other pages */
        .btn-back{background:#343a40;border:none;color:#fff;border-radius:8px;}
        .btn-back:hover{background:#23272b;}

        /* print overrides (your originals kept) */
        @media print{
            .no-print,button,a.btn:not(.btn-success){display:none!important;}
            .payment-card{box-shadow:none;border:none;}
        }
    </style>
</head>

<body>
<?php include 'headerC.php'; ?>

<?php
$id   = $_GET['id'];
$row1 = $conn->query("SELECT * FROM `ccontract` WHERE id='$id'")->fetch_assoc();
$case = $conn->query("SELECT * FROM `case` WHERE id='{$row1['caseid']}'")->fetch_assoc();
$user = $conn->query("SELECT * FROM `user` WHERE id='{$case['userid']}'")->fetch_assoc();
$fname=$user['fname']; $lname=$user['lname']; $email=$user['email'];
?>

<div class="container page-wrapper">
   
    <h2 class="section-title">Payment Contract&nbsp;for:&nbsp;<?= htmlspecialchars($fname.' '.$lname) ?></h2>

    <?php
    $payments = $conn->query("SELECT * FROM `payments` WHERE ccontractid='$id'");
    if($payments->num_rows):
        $idx = 0;
        while($p = $payments->fetch_assoc()):
            $idx++;
    ?>
    <!-- one card per payment -->
    <div class="payment-card">
        <h3 class="payment-header"><?= $idx ?><?= ($idx==1?'st':($idx==2?'nd':($idx==3?'rd':'th'))) ?> Payment Details</h3>
        <table class="payment-table w-100">
            <tr>
                <th>Payment</th>
                <td><input type="text" readonly value="<?= htmlspecialchars($p['amount']).' $' ?>"></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><input type="text" readonly value="<?= htmlspecialchars($p['date']) ?>"></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php if($p['status']==='UnPaid'): ?>
                        <a href="acceptpayment.php?acceptid=1&nbb=<?= $id ?>" class="btn-gradient btn-sm">
                            <i class="fas fa-check mr-1"></i> UnPaid
                        </a>
                    <?php else: ?>
                        <form action="paymentemail.php" method="post" class="d-inline no-print">
                            <input type="hidden" name="payid"   value="<?= $p['id']   ?>">
                            <input type="hidden" name="email"   value="<?= $email     ?>">
                            <input type="hidden" name="fname"   value="<?= $fname     ?>">
                            <input type="hidden" name="lname"   value="<?= $lname     ?>">
                            <input type="hidden" name="payment" value="<?= $p['amount']?>">
                            <button type="submit" class="btn-gradient btn-sm">
                                <i class="fas fa-check-circle mr-1"></i> Paid
                            </button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
    <?php endwhile; endif; ?>

    <!-- back button -->
    <div class="text-center">
        <a href="cashierindex.php" class="btn-back btn-action no-print">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
    </div>
</div><!-- /.page-wrapper -->

<!-- JS libs -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
