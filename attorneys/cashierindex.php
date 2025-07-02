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
    <title>TheFirm – Payments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"    content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon & Google Fonts (same as “Rejected Cases”) -->
    <link rel="icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS & Icon libraries (unchanged) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="lib/animate/animate.min.css">
    <link rel="stylesheet" href="lib/owlcarousel/assets/owl.carousel.min.css">

    <!-- Shared theme stylesheet -->
    <link rel="stylesheet" href="../css/admincss.css">

    <!-- Page-local styles copied from “Rejected Cases” -->
    <style>
        body{
            font-family:'Poppins',sans-serif;
            background:#f8f9fa;
        }
        /* outer spacing */
        .page-wrapper      {padding:3rem 0;}
        /* section heading style */
        .section-title{
            font-size:2rem;font-weight:600;padding-bottom:15px;margin-bottom:2rem;
            position:relative;color:#2c3e50;text-align:center;
        }
        .section-title:after{
            content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);
            width:80px;height:4px;border-radius:2px;background:linear-gradient(to right,#007bff,#00c6ff);
        }
        /* card + table look */
        .card{
            border:none;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,.08);
        }
        .card-header{
            background:#fff;border-bottom:1px solid rgba(0,0,0,.05);
            border-radius:15px 15px 0 0!important;padding:1.25rem 1.5rem;
        }
        .table thead th{
            background:#2c3e50;color:#fff;font-size:.85rem;text-transform:uppercase;
            letter-spacing:.5px;border:none;
        }
        .table tbody tr:hover{background:rgba(0,123,255,.05);}
        .table td{vertical-align:middle;font-size:.95rem;border-color:rgba(0,0,0,.03);}
        .case-description{max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#6c757d;}

        /* gradient action button to stay consistent */
        .btn-gradient{
            background:linear-gradient(45deg,#007bff,#00c6ff);border:none;
            color:#fff;font-weight:500;text-transform:uppercase;border-radius:8px;
            transition:.3s;padding:8px 20px;font-size:.9rem;
        }
        .btn-gradient:hover{
            background:linear-gradient(45deg,#0056b3,#007bff);transform:translateY(-2px);
            box-shadow:0 6px 20px rgba(0,123,255,.3);
        }

        /* search field same size as on rejected page */
        #searchInput{width:280px;max-width:500px;height:45px;}
    </style>
</head>

<body>
<?php include 'headerC.php'; ?>

<div class="container page-wrapper">
    <!-- page title -->
    <h2 class="section-title"><i class="fas fa-money-check-alt text-primary mr-2"></i>Payments</h2>

    <!-- main card -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-file-invoice-dollar mr-2 text-success"></i>All Payments</h5>
            <input id="searchInput" type="text" class="form-control" placeholder="Search by name ...">
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <?php
                $sql    = "SELECT * FROM `ccontract` WHERE status='Accepted'";
                $result = $conn->query($sql);
                ?>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Case Type</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = $result->fetch_assoc()):
                            $i++;
                            $caseRow    = $conn->query("SELECT * FROM `case` WHERE id='{$row['caseid']}'")->fetch_assoc();
                            $userRow    = $conn->query("SELECT * FROM user WHERE id='{$caseRow['userid']}'")->fetch_assoc();
                            $catRow     = $conn->query("SELECT * FROM category WHERE id='{$caseRow['categoryid']}'")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($userRow['fname'].' '.$userRow['lname']) ?></td>
                            <td><?= htmlspecialchars($userRow['email']) ?></td>
                            <td><?= htmlspecialchars($catRow['name']).' Case' ?></td>
                            <td>
                                <a href="cashierpayment.php?id=<?= $row['id'] ?>" class="btn-gradient">
                                    <i class="fas fa-file-contract mr-1"></i> Payment Bill
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- /.page-wrapper -->

<!-- footer identical to “Rejected Cases” -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between text-center">
        <p>&copy; 2025 TheFirm. All Rights Reserved.</p>
        <p class="mb-0">Designed by <a href="#" class="text-white">LegalTech Solutions</a></p>
    </div>
</footer>

<!-- JS libs -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<!-- search filter logic (same as rejected page) -->
<script>
$('#searchInput').on('input', function () {
    const q = this.value.toLowerCase();
    $('table tbody tr').each(function () {
        const cells = $(this).children('td');
        const match = (cells.eq(1).text().toLowerCase().includes(q) ||   // name
                       cells.eq(2).text().toLowerCase().includes(q) ||   // email
                       cells.eq(3).text().toLowerCase().includes(q));    // case type
        $(this).toggle(match);
    });
});
</script>
</body>
</html>
