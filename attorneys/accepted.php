<?php
session_start();
include 'header.php';
include 'db.php';

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}

$id=$_SESSION['attorney']['id'];
                ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm - Accepted Cases</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS (Bootstrap 5) -->
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

 <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/admincss.css" rel="stylesheet">
  
    <style>
        .modal-dialog {
    max-width: 90%; /* Adjust width as needed */
    width: 90%;
}

.modal-content {
    height: 90vh; /* Adjust height */
    overflow-y: auto; /* Enable scrolling if needed */
}


  .name-tooltip {
    position: relative;
    cursor: pointer;
    display: inline-block;
    color: #007bff;
    text-decoration: underline;
  }

  .name-tooltip .tooltip-text {
    visibility: hidden;
    width: max-content;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 4px;
    padding: 6px;
    position: absolute;
    z-index: 1;
    bottom: 125%; /* position above the text */
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
    white-space: nowrap;
  }

  .name-tooltip:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
  }


  .fake-textarea {
    width: 100%;
    min-height: 200px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    font-family: inherit;
    font-size: 14px;
    background-color: #fff;
    overflow-y: auto;
  }

  .name-tooltip {
    position: relative;
    cursor: pointer;
    color: #007bff;
    text-decoration: underline;
  }

  .name-tooltip .tooltip-text {
    visibility: hidden;
    background-color: #333;
    color: #fff;
    padding: 6px;
    border-radius: 4px;
    position: absolute;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
    white-space: nowrap;
    z-index: 1;
  }

  .name-tooltip:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
  }

  .modal-sm {
  max-width: 500px; /* or any width you prefer */
}
</style>

    
</head>

<body>
    <div class="wrapper">       

      
            <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center w-100"><i class="fas fa-briefcase text-primary mr-2"></i>Accepted Cases</h2>
         <button id="copyEmailBtn" class="btn btn-primary">
                    <i class="fas fa-envelope mr-2"></i>
                    Send Email
                </button>
    </div>

            <!-- Status Cards -->
            <div class="row status-cards mb-4">
                <div class="col-md-4 mb-4">
                    <div class="card status-card pending-card">
                        <a href="pending.php">
                            <div class="card-body text-center">
                                <div class="status-icon text-warning">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h5 class="card-title">Pending Cases</h5>
                                <?php
                                $sql10 = "SELECT * FROM `case` where status='Pending' AND attid='$id'";
                                $res10 = $conn->query($sql10);
                                $t10 = 0;
                                while ($row10 = $res10->fetch_assoc()) {
                                    $t10++;
                                }
                                ?>
                                <p class="display-4 font-weight-bold"><?php echo $t10; ?></p>
                                <small class="text-muted">Awaiting review</small>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card status-card accepted-card">
                        <a href="accepted.php">
                            <div class="card-body text-center">
                                <div class="status-icon text-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h5 class="card-title">Accepted Cases</h5>

                                <?php
                                $sql11 = "SELECT * FROM `case` where status='Accepted'  AND casestatus='Pending' AND attid='$id'";
                                $res11 = $conn->query($sql11);
                                $t11 = 0;
                                while ($row11 = $res11->fetch_assoc()) {
                                    $t11++;
                                }
                                ?>
                                <p class="display-4 font-weight-bold"><?php echo $t11; ?></p>
                                <small class="text-muted">Currently active</small>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card status-card rejected-card">
                        <a href="rejected.php">
                            <div class="card-body text-center">
                                <div class="status-icon text-danger">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <h5 class="card-title">Rejected Cases</h5>
                                <?php
                                $sql12 = "SELECT * FROM `case` where status='Rejected' AND attid='$id'";
                                $res12 = $conn->query($sql12);
                                $t12 = 0;
                                while ($row12 = $res12->fetch_assoc()) {
                                    $t12++;
                                }
                                ?>
                                <p class="display-4 font-weight-bold"><?php echo $t12; ?></p>
                                <small class="text-muted">Not proceeding</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cases Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Accepted Cases</h5>
                       <input type="text" id="searchInput" placeholder="Search By Name ,Case Type..." style="width: 280px; max-width:500px; height:45px;">
                    </div>
                </div>
   
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


                <div class="card-body p-0">
                    <div class="table-responsive">
                        <?php
                        $sql = "SELECT * FROM `case` where status='Accepted' AND attid='$id' AND casestatus='Pending' ORDER BY startdate DESC";
                        $result = $conn->query($sql);
                        ?>

                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Case Type</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Send</th>
                                    <th>Messages</th>
                                    <th>Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $TOT = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['categoryid'];
                                    $status = $row['status'];
                                    $userid = $row['userid'];
                                    $caseid = $row['id'];
                                    $TOT++;

                                    $sql1 = "SELECT * FROM user WHERE id = '$userid'";
                                    $res1 = $conn->query($sql1);
                                    $row1 = $res1->fetch_assoc();

                                    $sql3 = "SELECT * FROM category WHERE id = '$id'";
                                    $res3 = $conn->query($sql3);
                                    $row3 = $res3->fetch_assoc();
                                 ?>
                                    <tr>
                                        <td><?= $TOT ?></td>
                                        <td><?= $row1['fname'] . " " . $row1['lname'] ?></td>
                                        <td><?= $row3['name'] ?></td>
                                        <td><?= date('M d, Y', strtotime($row['startdate'])) ?></td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#descriptionModal<?= $row['id'] ?>">
        Description
    </button>

    <!-- Modal -->
    <div class="modal fade" id="descriptionModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="descriptionModalLabel<?= $row['id'] ?>" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="descriptionModalLabel<?= $row['id'] ?>">Case Description</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?= nl2br(htmlspecialchars($row['description'])) ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</td>

<td >
    <span class="status-badge status-accepted text-success font-weight-bold">
        <i class="fas fa-check mr-1"></i> Accepted
    </span>
</td>

                                        <td>
                                            <a href="acceptProcess.php?acceptid=0&nbb=<?= $row['id'] ?>" class="btn btn-danger btn-action">
                                                <i class="fas fa-times mr-1"></i> Reject
                                            </a>
                                        </td>

                                        <td>
                                                <!-- Send Message Button -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendMessageModal<?= $userid . '_' . $caseid ?>">
                                                    Send
                                                </button>

                                                <!-- Send Message Modal -->
                                                <div class="modal fade" id="sendMessageModal<?= $userid . '_' . $caseid ?>" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" style="max-width: 500px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="sendMessageModalLabel">Type Here</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="message.php">
                                                                    <input type="hidden" name="caseid" value="<?= $caseid; ?>">
                                                                    <input type="hidden" name="userid" value="<?= $userid; ?>">

                                                                    <div class="mb-3">
                                                                        <h3>To:</h3>
                                                                        <input type="text" class="form-control" value="<?= $row1['fname'] . " " . $row1['lname'] ?>" readonly />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <h3>Email:</h3>
                                                                        <input type="email" class="form-control" value="<?= $row1['email'] ?>" readonly />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <h3>Message:</h3>
                                                                        <textarea class="form-control" name="message" placeholder="For Meetings: https://example.com date:0000-00-00 time:00:00" required rows="5"></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-paper-plane me-2"></i>Send Message
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                     </div>
                                              </div>
                                        </td>

                                        <td>
 <!-- Receive Messages Button -->
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#receiveMessagesModal<?= $userid . '_' . $caseid ?>">
                                                   Show 
                                                </button>

                                                <!-- Receive Messages Modal -->
                                                <div class="modal fade" id="receiveMessagesModal<?= $userid . '_' . $caseid ?>" tabindex="-1" aria-labelledby="receiveMessagesModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" style="max-width: 500px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="receiveMessagesModalLabel">Received Messages</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $att = $_SESSION['attorney']['id'];
                                                                $sql5 = "SELECT usermss FROM chats WHERE userid='$userid' AND caseid='$caseid' AND attid='$att'";
                                                                $result5 = $conn->query($sql5);
                                                                $hasMessages = false;

                                                                if ($result5->num_rows > 0) {
                                                                    while ($row5 = $result5->fetch_assoc()) {
                                                                        $mss = $row5['usermss'];
                                                                        if (!empty($mss)) {
                                                                            echo "<div class='alert alert-secondary'>$mss</div>";
                                                                            $hasMessages = true;
                                                                        }
                                                                    }
                                                                }

                                                                if (!$hasMessages) {
                                                                    echo "<p class='text-muted'>No messages received yet.</p>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>

                                        <td> 

<!-- Receive Messages Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal<?=  $caseid ?>">
    Details
</button>

<!-- Contact Form Modal -->
<div class="modal fade" id="contactModal<?=  $caseid ?>" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">More Details</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
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
                                            <th>Session Address</th>  
                                            <th>Contract</th>
                                            <th>Case History</th>
                                            <th>Case Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>


                                            <!-- Additional columns for meeting status, session address, contract, case result -->
                                            <?php
$sql6 = "SELECT id,status,link,date,time FROM meetings WHERE caseid='$caseid' ORDER BY id DESC LIMIT 1";
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
     <a href="#" onclick="joinMeeting('<?= $row6['link'] ?>', <?= $row6['id'] ?>)" class="btn btn-success btn-action">
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
    <td><b>Not Scheduled yet</b></td>
    <?php
}
?>
                                           <td>
                                           <?php
$sql7 = "SELECT id,status,link FROM meetings WHERE caseid='$caseid' ";
$res7 = $conn->query($sql7);

if ($res7->num_rows > 0) { 
    $row7 = $res7->fetch_assoc();
    
        ?>
        <a href="location.php?pid=<?= $caseid ; ?>" class="btn btn-primary btn-action">
                                                Get The Location
                                            </a>
        <?php
    } else {
        ?>
        
    
   <b>Schedule a Meeting Before</b>

<?php
    }
    ?> 
                                           </td>

                                
                                            
                                            <td>
                                                <a href="contract.php?id=<?= $caseid ; ?>" class="btn btn-primary btn-action">
                                                    <i class="fas fa-file-contract mr-1"></i> Contract
                                                </a>
                                            </td>

                                            <td>
                                            <a href="history.php?id=<?= $caseid ; ?>" class="btn btn-primary btn-action">
                                                     History
                                                </a>
                                                </td>

                                                <?php
                                        
                                        $id=$_SESSION['attorney']['id'];
                                        $sql9 = "SELECT * FROM attorneys WHERE userid = '$id' ";
                                        $res9 = $conn->query($sql9);
                                        $row9 = $res9->fetch_assoc();
                                        $id=$row9['userid'];
                                        
                                        $sql14 = "SELECT * FROM cv WHERE userid = '$id'";
                                        $res14 = $conn->query($sql14);
                                        $row14 = $res14->fetch_assoc();
                                        $cvid=$row14['id'];
                                        
                                        $sql15 = "SELECT * FROM `ccontract` WHERE caseid='$caseid' AND status='Accepted'";
                                        $res15 = $conn->query($sql15);
                                        
                                        if ($res15->num_rows > 0) {
                                            $row15 = $res15->fetch_assoc();
                                            $ccid = $row15['id'];
                                            $caseid= $row15['caseid'];
                                        
                                            $sqlTotal = "SELECT COUNT(*) as total FROM `payments` WHERE ccontractid='$ccid'";
                                            $resTotal = $conn->query($sqlTotal);
                                            $rowTotal = $resTotal->fetch_assoc();
                                            $totalPayments = $rowTotal ? $rowTotal['total'] : 0; 
                                            
                                            $sqlAccepted = "SELECT COUNT(*) as accepted FROM `payments` WHERE ccontractid='$ccid' AND status='Paid'";
                                            $resAccepted = $conn->query($sqlAccepted);
                                            $rowAccepted = $resAccepted->fetch_assoc();
                                            $acceptedPayments = $rowAccepted ? $rowAccepted['accepted'] : 0; 
                                            
                                            if ($totalPayments == 0) {
                                                echo "<td>Make The Payments Bill.</td>";
                                            } elseif ($acceptedPayments >= ($totalPayments / 2)) {
                                                ?>
                                                <td class="d-flex gap-2">
                                                    <a href="resultProcess.php?resid=1&nbb=<?= $row1['id'] ; ?>&cvid=<?= $row14['id'] ?>&caseid=<?= $caseid ?>" class="btn btn-success btn-action">
                                                        <i class="fas fa-check mr-1"></i> Close
                                                    </a>
                                                   
                                                </td>
                                                <?php
                                            } else {
                                                echo "<td> Needs To Pay the Half Amount Before </td>";
                                              
                                            }
                                            
                                            } else {
                                                echo "<td> Make The Payment Contract</td>";
                                            }
                                            
                                        ?>
                                              
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
<h2 style="text-align:center ">Schedule a Zoom Meeting:</h2><br>
                 <form method="POST" action="zoomdate.php">
    <input type="hidden" name="caseid" value="<?= $caseid ; ?>">
    <strong><label>Meeting Link:</label></strong>
    <input type="url" name="link" placeholder="https://zoom.us/..." required>
    <strong><label>Select Meeting Date:</label></strong>    
    <input type="date" name="date" min="<?= date('Y-m-d'); ?>" required>
   <strong> <label>Start Time:</label></strong>
    <input type="time" name="stime" required>
    <strong><label>End Time:</label></strong>
    <input type="time" name="etime" required>
    <button type="submit" class="btn btn-primary btn-action">Set Meeting</button>
   <?php if (isset($_GET['error'])): ?>
    <script>
        alert("<?php echo $_GET['error']; ?>");
        // remove ?error=... from the URL
        window.location.href = "accepted.php";
    </script>
<?php endif; ?>

</form>

            </div>
        </div> <!-- Close modal-content -->
    </div> <!-- Close modal-dialog -->
    </div> <!-- Close modal -->
                                 </tr>
                                <?php
                            ob_start();
                        } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                            



<!-- Footer -->
<div class="footer bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0">&copy; 2025 TheFirm. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <p class="m-0">Designed by <a href="#" class="text-white">LegalTech Solutions</a></p>
            </div>
        </div>
    </div>
</div>


    <!-- Email List Modal -->
    <div class="modal fade" id="bulkEmailModal" tabindex="-1" role="dialog" aria-labelledby="bulkEmailModalLabel" aria-hidden="true">
        <div class=" modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkEmailModalLabel">Send Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="sendemail.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                           

<div id="emailTextArea" class="form-control fake-textarea" contenteditable="true">
  <?php
  $id = $_SESSION['attorney']['id'];
  $name=$_SESSION['attorney']['fullName'];
  $sql5 = "SELECT * FROM `case` WHERE status='Accepted' AND attid='$id'";
  $res5 = $conn->query($sql5);

  if ($res5->num_rows === 0) {
      echo "No cases found for this attorney.";
  } else {
      while ($row5 = $res5->fetch_assoc()) {
          $userid = $row5['userid'];
          $sql6 = "SELECT * FROM user WHERE id='$userid'";
          $res6 = $conn->query($sql6);
          if ($res6->num_rows === 0) {
              echo "No user found with ID: $userid <br>";
          } else {
              while ($row6 = $res6->fetch_assoc()) {
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;<span class='name-tooltip'>".$row6['fname']." ".$row6['lname']."
                          <span class='tooltip-text'>".$row6['email']."</span>
                        </span><br>";
                        ?>
                        <input type="hidden" name="attname" value="<?= $name ; ?>" />
                        <input type="hidden" name="email" value="<?= $row6['email'] ; ?>" id="emailInput" />
                        <?php
              }
          }
      }
  }
  ?>
</div>
<div style="text-align:center;">
<textarea name="sendemail" placeholder="Enter a message..."></textarea>
</div>
<script>
  // On form submit, copy textContent from the div into the hidden input
  document.querySelector("form").addEventListener("submit", function() {
    const htmlContent = document.getElementById("emailTextArea");
    const plainText = htmlContent.innerText.trim(); 
    document.getElementById("emailInput").value = plainText;
  });
</script>

                        </div>
                    </div>
                    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-black">
        <i class="fas fa-paper-plane mr-1"></i> Send
    </button>
</div>

                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <script>
   // Show email modal and automatically copy emails when the modal is opened
$('#copyEmailBtn').click(function() {
    // Show the modal
    $('#bulkEmailModal').modal('show');

    // Automatically copy the emails to the clipboard
    var emailTextArea = document.getElementById('emailTextArea');
    var emailContent = emailTextArea.value;

    // Use the Clipboard API to copy the text
    navigator.clipboard.writeText(emailContent).then(function() {
        // Show success message on the button that triggered the modal
        var originalText = $('#copyEmailBtn').html();
        $('#copyEmailBtn').html('<i class="fas fa-check mr-1"></i> Copied!');
        setTimeout(function() {
            $('#copyEmailBtn').html(originalText);
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });
});
</script>

</body>

</html>