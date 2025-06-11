<?php 
session_start();
include 'db.php'; 

if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attorney Contract - Kanun Law Firm</title>

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon" />

  <!-- Bootstrap & Font Awesome -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      padding: 40px 0;
      margin: 0;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background-color: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
      font-weight: 600;
      position: relative;
    }

    h1::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background: linear-gradient(to right, #007bff, #00c6ff);
      border-radius: 2px;
    }

    .contract-status {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
      padding: 15px;
      background-color: #e9ecef;
      border-left: 5px solid #007bff;
      border-radius: 8px;
      font-size: 1.1rem;
    }

    .contract-detail {
      margin-bottom: 25px;
    }

    .contract-label {
      font-weight: 600;
      color: #34495e;
    }

    .contract-value {
      padding: 10px 15px;
      background-color: #f8f9fa;
      border-radius: 8px;
      border: 1px solid #dee2e6;
      color: #495057;
    }

    .btn-back {
      display: block;
      width: 100%;
      margin-top: 30px;
      background: linear-gradient(45deg, #007bff, #00c6ff);
      border: none;
      color: white;
      padding: 12px;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.3s ease;
      text-align: center;
    }

    .btn-back:hover {
      background: linear-gradient(45deg, #0056b3, #007bff);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
      color: white;
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }
      h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
<?php
$id = $_GET['id'];

$sql = "SELECT * FROM `attcontract` WHERE attid='$id'";
$res = $conn->query($sql);

$sql1 = "SELECT * FROM `user` WHERE id='$id'";
$res1 = $conn->query($sql1);
$row1 = $res1->fetch_assoc();

$fname = $row1['fname'];
$lname = $row1['lname'];
?>
<div class="container">
  <h1>Existing Attorney Contract</h1>
  <div class="contract-status">
    <i class="fas fa-check-circle mr-2"></i>
    This is the contract issued under your name, Attorney <strong><?= htmlspecialchars($fname . " " . $lname); ?></strong>.
  </div>

  <?php while ($row = $res->fetch_assoc()): ?>
    <div class="contract-detail">
      <div class="contract-label"><i class="fas fa-dollar-sign mr-2"></i>Salary:</div>
      <div class="contract-value"><?= htmlspecialchars($row['salary']); ?></div>
    </div>

    <div class="contract-detail">
      <div class="contract-label"><i class="fas fa-calendar-alt mr-2"></i>Start Date:</div>
      <div class="contract-value"><?= htmlspecialchars($row['startdate']); ?></div>
    </div>

    <div class="contract-detail">
      <div class="contract-label"><i class="fas fa-calendar-times mr-2"></i>Expiry Date:</div>
      <div class="contract-value"><?= htmlspecialchars($row['expirydate']); ?></div>
    </div>

    <div class="contract-detail">
      <div class="contract-label"><i class="fas fa-clock mr-2"></i>Number of Hours:</div>
      <div class="contract-value"><?= htmlspecialchars($row['nbofHour']); ?></div>
    </div>

    <div class="contract-detail">
      <div class="contract-label"><i class="fas fa-file-alt mr-2"></i>Contract Details:</div>
      <div class="contract-value"><?= nl2br(htmlspecialchars($row['details'])); ?></div>
    </div>
  <?php endwhile; ?>

  <a href="index.php" class="btn-back">Back</a>
</div>

<!-- Optional JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
