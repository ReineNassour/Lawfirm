<?php
session_start();
include 'header.php';
include '../db.php';

if (!isset($_SESSION['admin']['id'])) {
    header('location: ../login.php');
    exit();
}

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
       
    </div>

            <!-- Status Cards -->
<div class="row status-cards mb-4 justify-content-center">
    <div class="col-md-4 mb-4">
        <div class="card status-card accepted-card text-center" style="padding: 10px; font-size: 0.9rem;">
            <a href="dashboard.php" style="text-decoration: none; color: inherit;">
                <div class="card-body p-2">
                    <div class="status-icon text-success mb-2" style="font-size: 1.8rem;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h6 class="card-title mb-1">Accepted Cases</h6>
                    <?php
                    $sql11 = "SELECT * FROM `case` where status='Accepted'  AND casestatus='Pending'";
                    $res11 = $conn->query($sql11);
                    $t11 = 0;
                    while ($row11 = $res11->fetch_assoc()) {
                        $t11++;
                    }
                    ?>
                    <p class="h4 font-weight-bold mb-1"><?php echo $t11; ?></p>
                    <small class="text-muted">Currently active</small>
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
                        $sql = "SELECT * FROM `case` where status='Accepted' AND casestatus='Pending' ORDER BY startdate DESC";
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
                                    <th>History</th>
                                    
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

                        <td>
                        <a href="history.php?id=<?= $caseid ; ?>" class="btn btn-primary btn-action">
                                     History
                         </a>
                        </td>    
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
                           


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    
</body>

</html>