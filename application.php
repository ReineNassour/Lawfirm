<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
include 'checkStatus.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Practice Areas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Practice Areas" name="keywords">
    <meta content="Explore our comprehensive legal practice areas and specializations" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Carousel -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="css/practice.css" rel="stylesheet">

    <style>
        .alert-info {
    background-color: #f0f8ff; /* A lighter background color */
    color: #000; /* Dark text color */
}

    </style>

</head>

<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
          
            
                <div class="col-12">
                    <h2>Here You Can Start With Your Attorney</h2>
                </div>
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="index.php">Home</a>
                        <a href="application.php">Track Your Application</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->



    <div class="wrapper">
        <!-- Main Content Start -->
        <div class="container dashboard-container">
            

            <!-- Status Card -->
            
                             <?php
                           $idd=  $_SESSION['user']['id'];

                        $sql2 = "SELECT * FROM `user` where  id='$idd'";
                        $res2 = $conn->query($sql2);
                        $row2=$res2->fetch_assoc();
                        $userid=$row2['id'];
                        ?>
           

            <!-- Cases Table -->
         <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div style="text-align: center;">
                <?php
                $sql9 = "SELECT * FROM `quiz` ORDER BY id DESC LIMIT 1 ";
                $res9 = $conn->query($sql9);

                if ($res9 && $res9->num_rows > 0) {
                    $row9 = $res9->fetch_assoc();
                    $quizid = $row9['id'];
                    $quizdate = $row9['date'];
                    $starttime = $row9['starttime'];
                    $endtime = $row9['endtime'];
                    $status = $row9['status'];

                    if ($status == 'Finished') {
                        // Check if user has submitted any answers
                        $sql4 = "SELECT * FROM `answers` WHERE userid = '$idd'";
                        $res4 = $conn->query($sql4);

                        if ($res4 && $res4->num_rows == 0) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Exam is Finished. You Have Not Attempted The Exam.</strong>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-info" role="alert">
                                <strong>You Will Be Notified Via 'Email' Once Your Result Is Available.</strong>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                      
                         <div class="alert alert-info" role="alert">
                            <strong>Exam Scheduled on:</strong> <?= date('F d, Y', strtotime($quizdate)) ?>
                           <strong> From: </strong> <?= date('h:i A', strtotime($starttime)) ?>
                          <strong>  Till: </strong><?= date('h:i A', strtotime($endtime)) ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<br>
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr style="text-align:center;">
                                    <th>Meetings</th>
                                    <th>Quiz</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                               
<tr style="text-align:center;">

<?php
$sql6 = "SELECT * FROM `application` WHERE userid='$userid'";
$res6 = $conn->query($sql6);

if ($res6->num_rows > 0) { 
    $row6 = $res6->fetch_assoc();
    $appid=$row6['id'];
    if ($row6['interviewStatus'] == 'Pending') {
     ?>
    <td>
     <a href="<?= $row6['interviewlink'],$appid ?>" target="_blank" class="btn btn-success btn-action">
        <?= ($row6['interviewlink']) ? "<b>On ".$row6['interviewdate']." at ".$row6['interviewtime']."</b>" : "Not Scheduled yet" ?>
     </a>
    </td>
        <?php
    } else{
        ?>
<h3>Meeting Completed</h3>
        <?php
    }
} else {
    ?>
    <td> <h3>No Meeting Scheduled</h3></td>
    <?php
}
$sql4 = "SELECT * FROM `answers` WHERE userid = '$userid'";
$res4 = $conn->query($sql4);

if ($res4->num_rows == 0) {
    ?>
    <td>
        <a href="quiz.php?id=<?= $quizid; ?>&user=<?= $userid; ?>" class="btn btn-success btn-action">
            <i class="fas fa-file-contract mr-1"></i> Quiz
        </a>
    </td>
    <?php
} else {
    ?>
    <td>
       <b> Thank You For Your Patience.</b>
    </td>
    <?php
}

$sql8 = "SELECT * FROM `quizresult` where  userid='$userid' ORDER BY id DESC LIMIT 1";
$result8 = $conn->query($sql8);
if($result8->num_rows > 0) {
$row8 = $result8->fetch_assoc();
$quizid=$row8['id'];
$result=$row8['result'];
if($result=='Passed'){
?>
       <td> <a href="quizresultpassed.php?id=<?php echo $quizid; ?>"><button type="button" class="btn btn-success">Result</button></a></td>
   <?php
    } else {
?>
<td> <a href="quizresultfailed.php?id=<?php echo $quizid; ?>"><button type="button" class="btn btn-success">Result</button></a></td>
<?php
} } else {
        echo "<td><b>Wait Till The End</b></td>";
    }
    ?>
</td>

</tr>

                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content End -->



   
<script>
    function openChat() {
            document.getElementById('chatBox').style.display = 'flex';
            document.getElementById('modalOverlay').style.display = 'block';
        }
        
        function closeChat() {
            document.getElementById('chatBox').style.display = 'none';
            document.getElementById('modalOverlay').style.display = 'none';
        }
</script>
      
<br><br><br>
<?php
include 'footer.php';
?>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->

  
</body>

</html>



