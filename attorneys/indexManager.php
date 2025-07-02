<?php
session_start();
include 'db.php';

if (!isset($_SESSION['manager'])) {
    header('location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Accepted Cases</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- favicon -->
    <link rel="icon" href="img/favicon.ico">

    <!-- Google fonts (shared) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS libs -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="lib/animate/animate.min.css">
    <link rel="stylesheet" href="lib/owlcarousel/assets/owl.carousel.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- shared palette / cards -->
    <link rel="stylesheet" href="../css/admincss.css">

    <!-- page-specific tweaks -->
    <style>
        :root{
            --primary:#2c3e50;--secondary:#3498db;--success:#28a745;
            --bg:#f8f9fa;--white:#fff;--gray-100:#f8f9fa;--gray-200:#e9ecef;
            --shadow:0 2px 4px rgba(0,0,0,.08)
        }
        body{background:var(--bg);font-family:'Poppins',Arial,Helvetica,sans-serif;}

        /* heading underline */
        .page-heading{position:relative;padding-bottom:.5rem;font-weight:600}
        .page-heading::after{
            content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);
            width:120px;height:4px;background:var(--secondary);border-radius:2px
        }

        /* status-cards */
        .status-card{border:none;box-shadow:var(--shadow)}
        .status-icon{font-size:2rem}
        .accepted-card .status-icon{color:var(--success)}

        /* table */
        .table thead th{
            background:var(--primary);color:var(--white);
            border-bottom:3px solid var(--secondary);
            text-transform:uppercase;font-size:.9rem;letter-spacing:.03em
        }
        tbody tr:hover td{background:var(--gray-100)}
        .case-description{max-width:240px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

        /* chart holder */
        .chart-card{border:none;box-shadow:var(--shadow)}

        /* payment badge */
        .status-badge{display:inline-block;padding:6px 10px;border-radius:6px;font-size:.85rem}
        .status-accepted{background:var(--success);color:var(--white)}

        /* “no payment” cell */
        .text-muted{opacity:.8}

        /* notification placeholder */
        #notification{display:none;position:fixed;top:20px;right:20px;background:#dc3545;color:#fff;
                      padding:10px 20px;border-radius:6px;box-shadow:var(--shadow)}
    </style>
</head>

<body>
<?php include 'headerM.php'; ?>

<div class="container py-5">

    <!-- page heading -->
    <h2 class="text-center mb-5 page-heading">
        <i class="fas fa-briefcase text-primary mr-2"></i>All Accepted Cases
    </h2>

    <!-- table card -->
    <div class="card shadow-sm mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <?php
                $sql    = "SELECT * FROM `case` WHERE status='Accepted' ORDER BY startdate DESC";
                $result = $conn->query($sql);
                ?>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Case Type</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $TOT = 0;
                    while($row=$result->fetch_assoc()):
                        $TOT++;
                        $rowUser = $conn->query("SELECT * FROM user WHERE id='{$row['userid']}'")->fetch_assoc();
                        $rowCat  = $conn->query("SELECT * FROM category WHERE id='{$row['categoryid']}'")->fetch_assoc();
                        $hasContract = $conn->query("SELECT id FROM ccontract WHERE caseid='{$row['id']}'")->num_rows;
                    ?>
                        <tr>
                            <td><?= $TOT ?></td>
                            <td><?= htmlspecialchars($rowUser['fname'].' '.$rowUser['lname']) ?></td>
                            <td><?= htmlspecialchars($rowUser['email']) ?></td>
                            <td><?= htmlspecialchars($rowCat['name']) ?></td>
                            <td><?= date('M d, Y',strtotime($row['startdate'])) ?></td>
                            <td class="case-description" title="<?= htmlspecialchars($row['description']) ?>">
                                <?= htmlspecialchars($row['description']) ?>
                            </td>
                            <?php if($hasContract): ?>
                                <td>
                                    <a href="Managerpayment.php?pid=<?= $row['id'] ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-money-bill-wave mr-1"></i> Payment
                                    </a>
                                </td>
                            <?php else: ?>
                                <td class="text-muted">No Payment Contract</td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /table card -->


    <!-- status + chart row -->
    <div class="row mb-5">
        <?php $acceptedCount = $conn->query("SELECT id FROM `case` WHERE status='Accepted'")->num_rows; ?>

        <div class="col-md-4 mb-4">
            <div class="card status-card accepted-card text-center py-4">
                <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                <h5 class="mt-2">Accepted Cases</h5>
                <p class="display-4"><?= $acceptedCount ?></p>
                <small class="text-muted">Currently active</small>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Accepted Cases Chart</h5>
                    <canvas id="acceptedChart" height="180"></canvas>
                </div>
            </div>
        </div>
    </div><!-- /row -->
</div><!-- /container -->


<!-- footer -->
<footer class="footer bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
                &copy; 2025 TheFirm. All Rights Reserved.
            </div>
            <div class="col-md-6 text-center text-md-right">
                Designed by <a class="text-white" href="#">LegalTech Solutions</a>
            </div>
        </div>
    </div>
</footer>


<!-- JS libs -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- chart init -->
<script>
fetch("getdataapi.php")
    .then(r=>r.json()).then(data=>{
        new Chart(document.getElementById('acceptedChart'),{
            type:'doughnut',
            data:{
                labels:['Accepted','Remaining'],
                datasets:[{
                    data:[data.count,100-data.count],
                    backgroundColor:['#28a745','#e9ecef'],
                    borderWidth:0
                }]
            },
            options:{
                responsive:true,cutout:'80%',
                plugins:{legend:{display:false},tooltip:{enabled:false}}
            }
        });
    }).catch(console.error);
</script>

<!-- nav highlight + tooltips -->
<script>
document.addEventListener('DOMContentLoaded',()=>{
    const path = window.location.pathname;
    document.querySelectorAll('.navbar-nav .nav-link').forEach(l=>{
        if(path.includes(l.getAttribute('href'))) l.classList.add('active');
    });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>
