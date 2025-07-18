<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TheFirm - Attorney Contract</title>
  <meta content="Law Firm Contract Management" name="keywords">
  <meta content="Attorney Contract Management System" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="../css/admincss.css" rel="stylesheet">
  <!-- CSS Libraries -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php include 'header.php' ; ?>

  <div id="main-body-form">

    <?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM `attcontract` where attid='$id'";
    $res = $conn->query($sql);
    $sql1 = "SELECT * FROM `user` where id='$id'";
    $res1 = $conn->query($sql1);
    $row1 = $res1->fetch_assoc();
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    if ($res->num_rows == 0) {
    ?>
      <div class="page-container">
        <div class="page-header">
          <a href="passedlawyers.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
          </a>
          <h1><i class="fas fa-file-signature mr-3"></i>Create Attorney Contract</h1>
        </div>

        <div class="form-container">
          <div class="contract-status">
            <i class="fas fa-user-tie"></i>
            <p class="mb-1">Initiating contract for</p>
            <h5 class="mb-0"><?= htmlspecialchars($fname . " " . $lname); ?></h5>
          </div>

          <form id="contractForm" method="POST" action="submitcontract.php">
            <div class="form-group">
              <label for="salary" class="form-label">Salary</label>
              <div class="input-icon">
                <i class="fas fa-dollar-sign"></i>
                <input type="number" class="form-control" id="salary" name="salary" placeholder="Enter annual salary" required>
              </div>
              <div id="salaryError" class="validation-error">Please enter a valid salary amount.</div>
            </div>

            <input type="hidden" name="attid" value="<?= htmlspecialchars($id); ?>">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date" class="form-label">Start Date</label>
                  <div class="input-icon">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                  </div>
                  <div id="startDateError" class="validation-error">Please select a valid start date.</div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="expiry_date" class="form-label">Expiry Date</label>
                  <div class="input-icon">
                    <i class="fas fa-calendar-times"></i>
                    <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                      min="<?php echo date('Y-m-d'); ?>" required>
                  </div>
                  <div id="expiryDateError" class="validation-error">Expiry date must be after start date.</div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="nb_of_hour" class="form-label">Weekly Working Hours</label>
              <div class="input-icon">
                <i class="fas fa-clock"></i>
                <input type="number" class="form-control" id="nb_of_hour" name="nb_of_hour" placeholder="Enter weekly hours" required>
              </div>
              <div id="hoursError" class="validation-error">Please enter valid working hours (1-60).</div>
            </div>

            <div class="form-group">
              <label for="details" class="form-label">Contract Details</label>
              <textarea class="form-control" id="details" name="details" rows="4" placeholder="Enter any additional contract details or terms..." required></textarea>
              <div id="detailsError" class="validation-error">Please provide contract details.</div>
            </div>

            <button type="submit" class="btn btn-primary-2 btn-block">
              <i class="fas fa-file-signature mr-2"></i>Create Contract
            </button>
          </form>
        </div>
      </div>
    <?php
    } else {
    ?>
      <div class="page-container">
        <div class="page-header">
          <a href="passedlawyers.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
          </a>
          <h1><i class="fas fa-file-contract mr-3"></i>Existing Attorney Contract</h1>
        </div>

        <div class="form-container">
          <div class="contract-status existing">
            <i class="fas fa-check-circle"></i>
            <p class="mb-1">Contract already exists for</p>
            <h5 class="mb-0"><?= htmlspecialchars($fname . " " . $lname); ?></h5>
          </div>

          <form id="contractForm" class="readonly-form">
            <?php
            while ($row = $res->fetch_assoc()) {
              $salary = $row['salary'];
              $startdate = $row['startdate'];
              $expirydate = $row['expirydate'];
              $nbofhour = $row['nbofHour'];
              $details = $row['details'];
            ?>
              <div class="form-group">
                <label class="form-label">Salary</label>
                <div class="input-icon">
                  <i class="fas fa-dollar-sign"></i>
                  <input type="text" class="form-control" value="<?= htmlspecialchars(number_format($salary)); ?>$" readonly>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <div class="input-icon">
                      <i class="fas fa-calendar-alt"></i>
                      <input type="text" class="form-control" value="<?= htmlspecialchars(date('F d, Y', strtotime($startdate))); ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">Expiry Date</label>
                    <div class="input-icon">
                      <i class="fas fa-calendar-times"></i>
                      <input type="text" class="form-control" value="<?= htmlspecialchars(date('F d, Y', strtotime($expirydate))); ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Weekly Working Hours</label>
                <div class="input-icon">
                  <i class="fas fa-clock"></i>
                  <input type="text" class="form-control" value="<?= htmlspecialchars($nbofhour); ?> hours per week" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Contract Details</label>
                <textarea class="form-control" rows="4" readonly><?= htmlspecialchars($details); ?></textarea>
              </div>
            <?php
            }
            ?>

            <div class="action-buttons-2">
              <a href="passedlawyers.php" class="btn btn-primary-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Lawyers
              </a>
            </div>
          </form>
        </div>
      </div>
    <?php
    }
    ?>

  </div>
  <!-- Add Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const contractForm = document.getElementById('contractForm');

      if (contractForm && contractForm.getAttribute('method') === 'POST') {
        // Only apply validation to the active form
        contractForm.addEventListener('submit', function(e) {
          let isValid = true;

          // Salary validation
          const salary = document.getElementById('salary');
          const salaryError = document.getElementById('salaryError');
          if (salary.value <= 0) {
            salaryError.style.display = 'block';
            isValid = false;
          } else {
            salaryError.style.display = 'none';
          }

          // Date validation
          const startDate = new Date(document.getElementById('start_date').value);
          const expiryDate = new Date(document.getElementById('expiry_date').value);
          const expiryDateError = document.getElementById('expiryDateError');

          if (expiryDate <= startDate) {
            expiryDateError.style.display = 'block';
            isValid = false;
          } else {
            expiryDateError.style.display = 'none';
          }

          // Hours validation
          const hours = document.getElementById('nb_of_hour');
          const hoursError = document.getElementById('hoursError');
          if (hours.value <= 0 || hours.value > 60) {
            hoursError.style.display = 'block';
            isValid = false;
          } else {
            hoursError.style.display = 'none';
          }

          // Details validation
          const details = document.getElementById('details');
          const detailsError = document.getElementById('detailsError');
          if (details.value.trim() === '') {
            detailsError.style.display = 'block';
            isValid = false;
          } else {
            detailsError.style.display = 'none';
          }

          if (!isValid) {
            e.preventDefault();
          }
        });
      }
    });
  </script>

<?php include 'footer.php' ; ?>

</body>

</html>