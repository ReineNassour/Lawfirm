<?php
session_start();
include 'header.php';
include 'db.php';

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Zoom Meetings Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"    content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts (shared stack) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css"        rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Shared admin palette / tables / cards -->
    <link href="../css/admincss.css" rel="stylesheet">

    <style>
        :root{
            --primary:#2c3e50; --secondary:#3498db; --background:#f8f9fa;
            --white:#fff;      --gray-100:#f8f9fa; --gray-200:#e9ecef;
            --shadow:0 2px 4px rgba(0,0,0,.1)
        }
        body{background:var(--background)}
        /* heading underline */
        .page-heading{position:relative;padding-bottom:.5rem;font-weight:600}
        .page-heading::after{
            content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);
            width:110px;height:4px;background:var(--secondary);border-radius:2px}
        /* calendar */
        .calendar-card      {border:none;box-shadow:var(--shadow)}
        .calendar-card th   {background:var(--primary);color:#fff;border-bottom:3px solid var(--secondary)}
        .calendar-card td   {vertical-align:top}
        .calendar-card tbody tr:hover td{background:var(--gray-100)}
        .date-cell{font-weight:600;width:90px}
        .today   td{background:#e3f2fd}
        .today .date-cell{color:var(--secondary)}
        .meeting-badge{
            background:var(--secondary);color:#fff;border-radius:6px;
            padding:6px 10px;margin:4px 4px;display:inline-block;font-size:.85rem;
            box-shadow:var(--shadow);transition:transform .2s}
        .meeting-badge:hover{transform:translateX(3px);box-shadow:0 3px 6px rgba(0,0,0,.15)}
        .meeting-time{font-size:.8rem;opacity:.9;margin-left:6px}
        .no-meetings{color:#adb5bd;font-style:italic}
        @media(max-width:576px){
            .meeting-badge{display:block;margin:4px 0}
        }
    </style>
</head>

<body>
<div class="container py-5">

    <!-- Page heading -->
    <div class="container py-2">
        <h2 class="text-center page-heading">
            <i class="far fa-calendar-alt text-primary mr-2"></i><?= date('F Y') ?> Sessions Calendar
        </h2>
    </div>

    <!-- Calendar Card -->
    <div class="card calendar-card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Sessions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    $todayDay     = date('j');
                    $currentMonth = date('m');
                    $currentYear  = date('Y');
                    $daysInMonth  = cal_days_in_month(CAL_GREGORIAN,$currentMonth,$currentYear);

                    $meetingsByDay = []; 
                    
                    $idd=$_SESSION['attorney']['id'];

                    $sql = "SELECT * FROM `session`";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {
                        $day  = date('j', strtotime($row['date']));
                        $time = date('h:i A',strtotime($row['time']));
                        $caseid=$row['caseid'];

$sqlCase = "SELECT * FROM `case` WHERE id='$caseid' AND attid='$idd'";
$resCase = $conn->query($sqlCase);
$row1    = $resCase->fetch_assoc();


$sqlAtt  = "SELECT * FROM `attorneys` WHERE userid='$idd'";
$resAtt  = $conn->query($sqlAtt);
$row3    = $resAtt->fetch_assoc();

if ($row1 && isset($row1['userid'])) {
    $userID  = $row1['userid'];

    $sqlUser = "SELECT * FROM `user` WHERE id='$userID'";
    $resUser = $conn->query($sqlUser);
    $row2    = $resUser->fetch_assoc();

    if ($row2 && isset($row2['fname'], $row2['lname'])) {
        $name = $row2['fname'] . ' ' . $row2['lname'];
        $meetingsByDay[$day][] = ['name' => $name, 'time' => $time];
    }
}

                    }

                    $todayDay     = date('j');
$currentMonth = date('m');
$currentYear  = date('Y');
$daysInMonth  = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// From today to end of month
for ($day = $todayDay; $day <= $daysInMonth; $day++) {
    $date    = "$currentYear-$currentMonth-$day";
    $dayName = date('l', strtotime($date));
    $isToday = ($day == date('j')) ? 'today' : '';

    echo "<tr class='$isToday'>";
    echo "<td class='date-cell'>$day</td>";
    echo "<td>$dayName</td>";
    echo "<td>";
    if (!empty($meetingsByDay[$day])) {
        foreach ($meetingsByDay[$day] as $m) {
            echo "<span class='meeting-badge'>{$m['name']}<span class='meeting-time'>{$m['time']}</span></span>";
        }
    } else {
        echo "<span class='no-meetings'>No Sessions scheduled</span>";
    }
    echo "</td></tr>";
}

// From start of month to day before today
for ($day = 1; $day < $todayDay; $day++) {
    $date    = "$currentYear-$currentMonth-$day";
    $dayName = date('l', strtotime($date));
    echo "<tr>";
    echo "<td class='date-cell'>$day</td>";
    echo "<td>$dayName <span class='text-muted'></span></td>";
    echo "<td>";
    if (!empty($meetingsByDay[$day])) {
        foreach ($meetingsByDay[$day] as $m) {
            echo "<span class='meeting-badge'>{$m['name']}<span class='meeting-time'>{$m['time']}</span></span>";
        }
    } else {
        echo "<span class='no-meetings'>No Sessions scheduled</span>";
    }
    echo "</td></tr>";
}

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /card -->

    <!-- Back button -->
    <div class="text-center mt-4">
        <a href="accepted.php" class="btn btn-primary">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
    </div>

</div>

   <?php include '../footer.php'; ?>

<!-- JS libs + nav highlight -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script>
    /* highlight nav */
    document.addEventListener('DOMContentLoaded',()=>{
        const path = window.location.pathname;
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link=>{
            if(path.includes(link.getAttribute('href'))) link.classList.add('active');
        });
    });
</script>
</body>
</html>
