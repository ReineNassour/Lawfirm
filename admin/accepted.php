<?php
session_start();
include "../db.php";
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm - Applicant Management</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Case Management" name="keywords">
    <meta content="Case Management System for Law Firms" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/admincss.css" rel="stylesheet">
</head>

<body>
    <?php include "header.php"; ?>

    <div class="container py-5">
        <h2 class="mb-4 text-center">Accepted Applicants Management</h2>

        <?php
        $sql = "SELECT * FROM cv where status='Accepted'";
        $result = $conn->query($sql);
        ?>

        <div class="row status-cards mb-5">
            <div class="col-md-4 mb-4">
                <div class="card status-card pending-card h-100">
                    <a href="applicants.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5 class="card-title">Pending Applicants</h5>
                            <?php
                            $sql10 = "SELECT * FROM `cv` where status='Pending'";
                            $res10 = $conn->query($sql10);
                            $t10 = 0;
                            while ($row10 = $res10->fetch_assoc()) {
                                $t10++;
                            }
                            ?>
                            <p class="display-4"><?php echo $t10; ?></p>
                            <small>Awaiting review</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card status-card accepted-card h-100">
                    <a href="accepted.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="card-title">Accepted Applicants</h5>
                            <?php
                            $sql11 = "SELECT * FROM `cv` 
          WHERE status='Accepted' 
          AND userid NOT IN (
              SELECT userid FROM `attorneys` 
              UNION 
              SELECT userid FROM `quizresult`
          )";
                            $res11 = $conn->query($sql11);
                            $t11 = 0;
                            while ($row11 = $res11->fetch_assoc()) {
                                $t11++;
                            }
                            ?>
                            <p class="display-4"><?php echo $t11; ?></p>
                            <small>Currently active</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card status-card rejected-card h-100">
                    <a href="rejected.php">
                        <div class="card-body text-center">
                            <div class="status-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h5 class="card-title">Rejected Applicants</h5>
                            <?php
                            $sql12 = "SELECT * FROM `cv` where status='Rejected'";
                            $res12 = $conn->query($sql12);
                            $t12 = 0;
                            while ($row12 = $res12->fetch_assoc()) {
                                $t12++;
                            }
                            ?>
                            <p class="display-4"><?php echo $t12; ?></p>
                            <small>Not proceeding</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2 text-primary"></i> Schedule Quiz Date</h5>
            </div>
            <div class="card-body">
                <form action="sendquizdate.php" method="post" class="row g-3">
                    <div class="col-md-3">
                        <label for="quiz_date" class="form-label">Quiz Date</label>
                        <input type="date" name="quiz_date" id="quiz_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="quiz_time" class="form-label">Start Time</label>
                        <input type="time" name="quiz_time" id="quiz_time" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="endtime" class="form-label">End Time</label>
                        <input type="time" name="endtime" id="endtime" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="d-block invisible">Submit</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-calendar-check mr-2"></i> Schedule Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        $sql4 = "SELECT * FROM `quiz` ORDER BY id DESC LIMIT 1";
        $res4 = $conn->query($sql4);

        if ($res4->num_rows > 0) {
            $row4 = $res4->fetch_assoc();
            $quizid = $row4['id'];
            $quizdate = $row4['date']; // Format: Y-m-d (assuming)
            $starttime = $row4['starttime']; // Format: H:i
            $endtime = $row4['endtime'];     // Format: H:i
            $status = $row4['status'];
            // Combine date and time
            $endDateTimeStr = $quizdate . ' ' . $endtime;
            $endDateTime = new DateTime($endDateTimeStr);
            $currentDateTime = new DateTime();

            // Exam is over
            if ($currentDateTime > $endDateTime) {
                if ($status == 'Pending') {
                    $updateStatusSql = "UPDATE `quiz` SET status = 'Finished' WHERE id = '$quizid'";
                    $conn->query($updateStatusSql);
        ?>
                    <div class="alert alert-warning" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle mr-3" style="font-size: 24px;"></i>
                            <strong>The Exam Has Ended</strong>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-warning" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle mr-3" style="font-size: 24px;"></i>
                            <strong>The Exam Has Ended</strong>
                        </div>
                    </div>
                <?php
                }
            } else {
                // Exam still upcoming or ongoing
                ?>
                <div class="alert alert-info" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle mr-3" style="font-size: 24px;"></i>
                        <div>
                            <strong>Exam Scheduled:</strong> <?= date('F d, Y', strtotime($quizdate)) ?>
                            from <strong><?= date('h:i A', strtotime($starttime)) ?></strong>
                            to <strong><?= date('h:i A', strtotime($endtime)) ?></strong>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-user-check mr-2 text-primary"></i> Accepted Applicants</h5>
                 <input type="text" id="searchInput" placeholder="Search By Name ..." style="width: 280px; max-width:500px; height:45px;">
   
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
                <span class="badge bg-success text-white px-3 py-2"><?= $t11 ?> Active Applicants</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Send</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $t = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $t++;
                                    $cvid = $row['id'];
                                    $userid = $row['userid'];

                                    $sql7 = "SELECT * FROM `quizresult` where quizid='$quizid' AND userid='$userid'";
                                    $res7 = $conn->query($sql7);

                                    if ($res7->num_rows == 0) {
                                        $sql1 = "SELECT * FROM user WHERE id='$userid' AND role=0";
                                        $result1 = $conn->query($sql1);
                                         while ($row2 = $result1->fetch_assoc()) {
                                            $id = $row2['id'];
                                            $fname = $row2['fname'];
                                            $lname = $row2['lname'];
                                            $name = $fname . " " . $lname;
                                            $email = $row2['email'];
                                                  ?>
                                            <tr>
                                                <td><?= $t; ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar mr-3" style="background: #3498db; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                            <?= strtoupper(substr($fname, 0, 1) . substr($lname, 0, 1)); ?>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0"><?= $name; ?></h6>
                                                            <small class="text-muted"><?= $email; ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendMessageModal<?= $userid . '_' . $cvid ?>">
                                                        <i class="fas fa-paper-plane mr-2"></i> Send
                                                    </button>

                                                    <!-- Send Message Modal -->
                                                    <div class="modal fade" id="sendMessageModal<?= $userid . '_' . $cvid ?>" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="sendMessageModalLabel">Send Message</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="message.php">
                                                                        <input type="hidden" name="cvid" value="<?= $cvid; ?>">
                                                                        <input type="hidden" name="userid" value="<?= $userid; ?>">

                                                                        <div class="mb-3">
                                                                            <h3>To:</h3>
                                                                            <input type="text" class="form-control" value="<?= $name ?>" readonly />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <h3>Email:</h3>
                                                                            <input type="email" class="form-control" value="<?= $email ?>" readonly />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <h3>Message:</h3>
                                                                            <textarea class="form-control" name="message" placeholder="Type your message here..." required rows="5"></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary w-100">
                                                                            <i class="fa fa-paper-plane me-2"></i>Send Message
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <form action="sendemailRejected.php" method="post">
                                                        <?php $adname = $_SESSION['admin']['fullName']; ?>
                                                        <input type="hidden" name="adname" value="<?= $adname; ?>">
                                                        <input type="hidden" name="userid" value="<?= $row2['id']; ?>">
                                                        <input type="hidden" name="cvid" value="<?= $row['id']; ?>">
                                                        <input type="hidden" name="email" value="<?= $row2['email']; ?>">
                                                        <input type="hidden" name="name" value="<?= $name; ?>">
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-ban mr-1"></i> Reject
                                                        </button>
                                                    </form>
                                                </td>

                                                <td>
                                                    <!-- Details Button -->
                                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailsModal<?= $userid . '_' . $cvid ?>">
                                                        <i class="fas fa-info-circle mr-1"></i> Details
                                                    </button>

                                                    <!-- Details Modal -->
                                                    <div class="modal fade" id="detailsModal<?= $userid . '_' . $cvid ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?= $userid . '_' . $cvid ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailsModalLabel<?= $userid . '_' . $cvid ?>">
                                                                        <i class="fas fa-user-tie mr-2"></i> <?= $name ?> - Details
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card shadow-sm mb-4">
                                                                        <div class="card-header bg-light">
                                                                            <h6 class="mb-0">Application Status</h6>
                                                                        </div>
                                                                        <div class="card-body p-0">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover mb-0">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Meeting Status</th>
                                                                                            <th>Quiz Answers</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <!-- Meeting status column -->
                                                                                            <?php
                                                                                            $sql6 = "SELECT * FROM `application` WHERE userid='$userid'";
                                                                                            $res6 = $conn->query($sql6);

                                                                                            if ($res6->num_rows > 0) {
                                                                                                $row6 = $res6->fetch_assoc();
                                                                                                if ($row6['interviewStatus'] == 'Done') {
                                                                                            ?>
                                                                                                    <td>
                                                                                                        <span class="badge bg-success text-white p-2">
                                                                                                            <i class="fas fa-check-circle mr-1"></i> Meeting Completed
                                                                                                        </span>
                                                                                                    </td>
                                                                                                <?php
                                                                                                } else {
                                                                                                ?>
                                                                                                    <td>
                                                                                                        <a href="#" onclick="joinMeeting('<?= $row6['interviewlink'] ?>', <?= $row6['id'] ?>)" class="btn btn-primary">
                                                                                                            <?= ($row6['interviewlink']) ? "<i class='fas fa-video mr-1'></i> Join Meeting on " . date('F d, Y', strtotime($row6['interviewdate'])) : "<i class='fas fa-calendar-times mr-1'></i> Not Scheduled yet" ?>
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
                                                                                                                    window.location.href = 'accepted.php';
                                                                                                                })
                                                                                                                .catch(error => console.error('Error:', error));
                                                                                                        }
                                                                                                    </script>
                                                                                                <?php
                                                                                                }
                                                                                            } else {
                                                                                                ?>
                                                                                                <td>
                                                                                                    <span class="badge bg-secondary text-white p-2">
                                                                                                        <i class="fas fa-calendar-times mr-1"></i> No Meeting Scheduled
                                                                                                    </span>
                                                                                                </td>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                            <td>
                                                                                                <a href="quizanswers.php?id=<?= $userid; ?>" class="btn btn-primary">
                                                                                                    <i class="fas fa-file-alt mr-1"></i> View Quiz Answers
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Extra Scripts -->
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Add active class to current page nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                if (currentLocation.includes(link.getAttribute('href'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>