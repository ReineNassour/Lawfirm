<?php
session_start();
include 'checkStatus.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
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

.dashboard-container {
    width: 100%;
}

.table-responsive {
    width: 100%;
}

.table {
    width: 100% !important;
    table-layout: auto;
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
                        <a href="practice.php">Track Your Case</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->



    <div class="wrapper">
        <!-- Main Content Start -->
       <div class="container-fluid dashboard-container">
                             <?php
                           $idd=  $_SESSION['user']['id'];
                        ?>
           

            <!-- Cases Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                     <th>#</th>
                                    <th>Attorney</th>
                                    <th>Messages</th>
                                    <th>Messages </th>
                                    <th>Sessions/Meetings</th>
                                    <th>Case Contract</th>
                                    <th>Payment Contract</th>
                                    <th>Payment Bill</th>
                                    <th>Rate Your Attorney</th>
                                    <th>Case History</th>
                                    <th>Documents</th>
                                    <th>Case Result</th>
                                </tr>
                            </thead>
                            <tbody>
                               
<tr>
<?php
 $sql16 = "SELECT * FROM `case` where status='Accepted' AND userid='$idd'";
 $result16 = $conn->query($sql16);
 $t=0;
 while($row16=$result16->fetch_assoc()){
    $t++;
 $att=$row16['attid'];
 $caseid=$row16['id'];

 $sql1 = "SELECT * FROM `attorneys` where  userid='$att' ";
                        $res1 = $conn->query($sql1);
                        $row1=$res1->fetch_assoc();
                        $id=$row1['userid'];

    $sql2 = "SELECT * FROM `user` where id='$id' ";
                        $res2 = $conn->query($sql2);
                        $row2=$res2->fetch_assoc();
                        $fname=$row2['fname'];
                        $lname=$row2['lname'];
                        $name=$fname." ".$lname;
                        
                        ?>

<td><?= $t ; ?></td>
<td><?= "<p>".$name."</p>" ; ?></td>


    <td>

<!-- Receive Button (Unique Modal ID) -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal<?= $caseid ?>">Show</button>

<!-- Contact Form Modal (Unique Modal ID) -->
<div class="modal fade" id="contactModal<?= $caseid ?>" tabindex="-1" aria-labelledby="contactModalLabel<?= $caseid ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel<?= $caseid ?>">Show </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php


$sql5 = "SELECT attmss FROM chats WHERE userid='$idd' AND attid='$att' AND caseid='$caseid' ORDER BY id DESC";
$result5 = $conn->query($sql5);

if ($result5 && $result5->num_rows > 0) {
    while ($row5 = $result5->fetch_assoc()) {
        if (!empty($row5['attmss'])) {
            echo "<div class='alert alert-secondary'>" . htmlspecialchars($row5['attmss']) . "</div>";
        }
    }
}
else {
    echo "<div class='alert alert-info'>No messages received yet.</div>";
}


?>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    </td>

    <td>

 <!-- Send Button (Unique Modal ID) -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendModal<?= $caseid ?>">Send</button>

<!-- Send Modal (Unique Modal ID) -->
<div class="modal fade" id="sendModal<?= $caseid ?>" tabindex="-1" aria-labelledby="sendModalLabel<?= $caseid ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendModalLabel<?= $caseid ?>">Type Here</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message_'.$caseid])) {
                    $userid = $_SESSION['user']['id'];
                    $message = $_POST['message'];

                    $sql22 = "INSERT INTO chats (usermss, attmss, time, userid, attid, caseid) 
                              VALUES ('$message', '', NOW(), '$userid', '$att', '$caseid')";
                    if ($conn->query($sql22) === TRUE) {
                        echo "<script>window.location.href='track.php';</script>"; 
                        exit();
                    } else {
                        echo "<p class='text-danger'>Error: " . $conn->error . "</p>";
                    }
                }
                ?>
                <form method="post">
                    <div class="mb-3">
                        <h3>To :</h3>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($fname . ' ' . $lname); ?>" readonly />
                    </div>
                    <div class="mb-3">
                        <h3>Email :</h3>
                        <input type="email" class="form-control" value="<?= htmlspecialchars($row2['email']); ?>" readonly />
                    </div>
                    <div class="mb-3">
                        <h3>Message :</h3>
                        <textarea class="form-control" name="message" placeholder="Send a Message" required rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="send_message_<?= $caseid ?>">
                        <i class="fa fa-paper-plane me-2"></i>Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

    </td>

    <td>

<!-- Details Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $caseid ?>">Details</button>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal<?= $caseid ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?= $caseid ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel<?= $caseid ?>">More Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
             <div class="modal-body">
                <form method="post" action="">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            
                                            <th>Meeting Status</th>
                                            <th>Session Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           
                                            <!-- Additional columns for meeting status, session address, contract, case result -->
                                            <?php
$sql6 = "SELECT * FROM meetings WHERE caseid='$caseid' ORDER BY id DESC LIMIT 1";
$res6 = $conn->query($sql6);

if ($res6->num_rows > 0) { 
    $row6 = $res6->fetch_assoc();
    if ($row6['status'] == 'Done') {
        ?>
        <td><b>Meeting Completed</b></td>
        <?php
    } else {
        ?>
        
    <td>
     <a href="#" onclick="joinMeeting('<?= $row6['link'] ?>', <?= $row6['id'] ?>)" class="btn btn-primary btn-action">
        <?= ($row6['link']) ? "<b>Join Meeting on ".$row6['date']." at ".$row6['time']."</b>" : "Not Scheduled yet" ?>
     </a>
    </td>

<script>
function joinMeeting(link, meetingId) {
    // Send AJAX request to update meeting status
    fetch('zoom.php?acceptid=0&nbb=' + meetingId)
        .then(response => response.text())
        .then(() => {
            // Once status is updated, open Zoom link
            window.open(link, '_blank');
            window.location.href = 'accepted.php'; // Redirect after opening the meeting
        })
        .catch(error => console.error('Error:', error));
}
</script>
        <?php
    }
} else {
    ?>
    <td><b>No Meeting is Scheduled yet</b></td>
    <?php
}
?>
                                           <td>
                                           <?php
$sql7 = "SELECT * FROM `session` WHERE caseid='$caseid' ORDER BY id DESC LIMIT 1";
$res7 = $conn->query($sql7);

if ($res7->num_rows > 0) { 
    $row7 = $res7->fetch_assoc();
    
    $sql8 = "SELECT * FROM `address` where caseid='$caseid' ORDER BY id DESC LIMIT 1";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();
    $addressText = "<br><b>Location:</b> " . htmlspecialchars($row8['details']) . ",<b> City:</b> " .
        htmlspecialchars($row8['city']) . ", <b>Building:</b> " .
        htmlspecialchars($row8['building']) . ",<b> Street:</b> " .
        htmlspecialchars($row8['street']);

        $sql9 = "SELECT * FROM `judge` where caseid='$caseid' ORDER BY id DESC LIMIT 1";
        $result9 = $conn->query($sql9);
        $row9 = $result9->fetch_assoc();
        $judge = "<br><b>Judge name:</b> " . htmlspecialchars($row9['name']);

    echo "<b>Date:</b> " . htmlspecialchars($row7['date']) . "<br>";
    echo "<b>Time:</b> " . htmlspecialchars($row7['time']) . "<br>";
    echo "<b>Message:</b> " . nl2br(htmlspecialchars($row7['details'])) . "<br>"; 
    echo $addressText."<br>"; 
    echo $judge;  

    } else {
        ?>
   <b>No Session is scheduled yet</b>

<?php
    }
    ?> 
                                           </td>
                                            
                                           
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- Close modal-content -->
    </div> <!-- Close modal-dialog -->
    </div> <!-- Close modal -->

    </td>

    <td><a href="contract.php?id=<?= $caseid ; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">Contract</button></a>
    </td>

    <td>
        <a href="payment.php?id=<?= $caseid ; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">Payment</button></a>
    </td>

    <td>
        <a href="paymentbill.php?id=<?= $caseid ; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">Bill</button></a>
    </td>

    <td>
    <a href="attorneys.php?id=<?= $caseid ; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">Rate</button></a>
    </td>

    <td> <a href="history.php?id=<?= $caseid ; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">History</button></a></td>

<td> <a href="documents.php?id=<?= $caseid ; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">Docs</button></a></td>


    <td>
    <?php
$sql8 = "SELECT * FROM `case` where  userid='$idd' AND attid='$att' AND id='$caseid'";
$result8 = $conn->query($sql8);
$row8 = $result8->fetch_assoc();
$casestatus = $row8['casestatus'];
$caseId = $row8['id'];

?>
    <?php
    if ($casestatus == 'Closed') {
       
        ?>
        <a href="finished.php?caseId=<?php echo $caseId; ?>"><button type="button" class="btn btn-primary">Closed</button></a>
   <?php
    } else {
        echo "Wait Till The End";
    }
    ?>
</td>

</tr>

                            </tbody>
                            <?php
                        }
                        ?>
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



