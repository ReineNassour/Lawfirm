<?php
session_start();
include '../db.php';

if (!isset($_SESSION['manager'])) {
    header('location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Applicants Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"    content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts (shared stack) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"   rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  rel="stylesheet">
    <link href="lib/animate/animate.min.css"                    rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css"    rel="stylesheet">

    <!-- Shared palette / cards -->
    <link href="../css/admincss.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Page-specific tweaks -->
    <style>
        .dashboard-title  { font-weight:600;margin-top:30px }
        .status-card      { transition:transform .2s }
        .status-card:hover{ transform:scale(1.02) }
        .status-icon      { font-size:2.5rem;margin-bottom:10px }
        .case-description { max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis }
        .table th,.table td{ vertical-align:middle }
    </style>
</head>

<body>

<?php include 'headerM.php'; ?>

<?php
$sql = "SELECT * FROM `cv`
        WHERE status='Accepted'
          AND userid NOT IN (
              SELECT userid FROM `attorneys`
              UNION
              SELECT userid FROM `quizresult`
          )";
$result = $conn->query($sql);
?>

<div class="container py-2">

    <!-- ===== Heading ===== -->
    <div class="container py-2 text-center">
        <h2 class="dashboard-title">
            <i class="fas fa-user-graduate text-primary mr-2"></i>Applicants Overview
        </h2>
    </div>

    <!-- ===== Status cards ===== -->
   <div class="row status-cards mb-4">

    <!-- Pending Applicants -->
    <div class="col-md-4 mb-4">
        <div class="card status-card pending-card">
            <a href="pending.php" class="text-decoration-none text-reset">
                <div class="card-body text-center">
                    <div class="status-icon text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="card-title">Pending Applicants</h5>
                    <?php
                    $t10 = $conn->query("SELECT id FROM cv WHERE status='Pending'")->num_rows;
                    ?>
                    <p class="display-4 font-weight-bold"><?php echo $t10; ?></p>
                    <small class="text-muted">Awaiting review</small>
                </div>
            </a>
        </div>
    </div>

    <!-- Accepted Applicants -->
    <div class="col-md-4 mb-4">
        <div class="card status-card accepted-card">
            <a href="accepted.php" class="text-decoration-none text-reset">
                <div class="card-body text-center">
                    <div class="status-icon text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h5 class="card-title">Accepted Applicants</h5>
                    <?php
                    $t11 = $conn->query($sql)->num_rows;
                    ?>
                    <p class="display-4 font-weight-bold"><?php echo $t11; ?></p>
                    <small class="text-muted">Currently active</small>
                </div>
            </a>
        </div>
    </div>

    <!-- Chart Card (Styled similarly, but no link) -->
    <div class="col-md-4 mb-4">
        <div class="card status-card chart-card">
            <div class="card-body text-center">
                <div class="status-icon text-info">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h5 class="card-title">Applicants Chart</h5>
                <canvas id="myChart" height="120"></canvas>
            </div>
        </div>
    </div>

</div>

    <?php
    $row9 = $conn->query("SELECT * FROM quiz WHERE status='Pending' ORDER BY id DESC LIMIT 1")->fetch_assoc();
    if ($row9) {
        $quizid   = $row9['id'];
        $quizdate = $row9['date'];
        $quiztime = $row9['starttime'];
        $endtime  = $row9['endtime'];
    ?>
        <div class="alert alert-info text-center">
            <strong>Exam Scheduled On:</strong> <?= $quizdate ?>
            <strong>At:</strong> <?= date('h:i', strtotime($quiztime)) ?> pm
            <strong>Till:</strong> <?= date('h:i', strtotime($endtime)) ?> pm
            &nbsp;&nbsp;
            <?php
            if ($conn->query("SELECT id FROM question WHERE quizid='$quizid'")->num_rows == 0) {
                echo '<a href="addquiz.php?id='.$quizid.'" class="btn btn-primary btn-sm"><i class="fas fa-file-contract mr-1"></i> Add Exam Questions</a>';
            }
            ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger text-center"><strong>No Exam Scheduled Yet.</strong></div>
    <?php } ?>

    <!-- ===== Applicants table ===== -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-users mr-2 text-primary"></i>Accepted Applicants</h5>
            <span class="badge bg-success text-white px-3 py-2"><?= $t11 ?> Total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>View CV</th>
                            <th>Meetings</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $counter = 0;
                    while ($row = $result->fetch_assoc()) {
                        $counter++;
                        $user   = $conn->query("SELECT * FROM user WHERE id='{$row['userid']}'")->fetch_assoc();
                        $app    = $conn->query("SELECT * FROM application WHERE userid='{$row['userid']}'")->fetch_assoc();
                    ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo htmlspecialchars($user['fname'].' '.$user['lname']); ?></td>
                            <td>
                                <a href="cv.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-contract mr-1"></i> CV
                                </a>
                            </td>
                            <td>
                                <?php if ($app) {
                                    if ($app['interviewStatus'] == 'Done') { ?>
                                        <span class="badge badge-success p-2">Meeting Completed</span>
                                    <?php } else { ?>
                                        <a href="#"
                                           class="btn btn-success btn-sm"
                                           onclick="joinMeeting('<?= $app['interviewlink'] ?>', <?= $app['id'] ?>)">
                                           <?= $app['interviewlink']
                                                 ? '<b>Join Meeting on '.$app['interviewdate'].' at '.$app['interviewtime'].'</b>'
                                                 : 'Not Scheduled yet'; ?>
                                        </a>
                                <?php }} else { echo '<span class="text-muted">Not Scheduled yet</span>'; } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /card -->
</div><!-- /container -->

<!-- ===== Footer ===== -->
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

<!-- ===== JS libs + helpers ===== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script>
/* ===== build mini-chart ===== */
fetch('applicantsapi.php')
    .then(r=>r.json()).then(d=>{
        if(!d.length) return;
        const labels = d.map(i=>'User '+i.userid),
              values = d.map(i=>i.accepted_count);
        new Chart(document.getElementById('myChart'),{
            type:'bar',
            data:{ labels,
                   datasets:[{ label:'Accepted Applications',
                               data:values,
                               backgroundColor:'rgba(75,192,192,.3)',
                               borderColor:'rgba(75,192,192,1)',
                               borderWidth:1 }]},
            options:{ scales:{ y:{ beginAtZero:true }}}
        });
    });

/* ===== nav highlight + tooltips ===== */
$(function(){
    const path = window.location.pathname;
    $('.navbar-nav .nav-link').each(function(){
        if(path.includes($(this).attr('href'))) $(this).addClass('active');
    });
    $('[data-toggle="tooltip"]').tooltip();
});

/* ===== meeting join helper ===== */
function joinMeeting(link,id){
    fetch('zoomapp.php?acceptid=0&nbb='+id)
        .then(()=>{ window.open(link,'_blank'); location.href='application.php';})
        .catch(console.error);
}
</script>
</body>
</html>
