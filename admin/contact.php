<?php
session_start();
include '../db.php';

if(!isset($_SESSION['admin']['id'])) {
    header("Location: login.php");
    exit();
} else {
    $adminid = $_SESSION['admin']['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Contact Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --primary: #2c3e50;
      --secondary: #3498db;
      --success: #2ecc71;
      --background: #f4f4f4;
      --white: #ffffff;
      --gray: #95a5a6;
      --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: var(--background);
      margin: 0;
      padding: 40px 20px;
      color: var(--primary);
    }

    .container {
      max-width: 1100px;
      margin: auto;
      background: var(--white);
      padding: 30px;
      box-shadow: var(--shadow);
      border-radius: 12px;
    }

    h2 {
      margin-bottom: 30px;
      font-size: 32px;
      color: var(--primary);
      font-weight: 600;
      border-bottom: 3px solid var(--secondary);
      padding-bottom: 10px;
      display: inline-block;
    }

    form {
      margin-bottom: 40px;
      background: #f8f9fa;
      padding: 25px;
      border-radius: 8px;
      border: 1px solid #e9ecef;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: 500;
      color: var(--primary);
    }

    textarea {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #dee2e6;
      margin-bottom: 20px;
      resize: vertical;
      min-height: 120px;
      transition: border-color 0.3s ease;
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.075);
    }

    textarea:focus {
      outline: none;
      border-color: var(--secondary);
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    button {
      background: var(--secondary);
      color: var(--white);
      border: none;
      padding: 12px 25px;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: var(--shadow);
    }

    button:hover {
      background: #2980b9;
      transform: translateY(-1px);
      box-shadow: 0 6px 8px rgba(0,0,0,0.15);
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      background: var(--white);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    th, td {
      padding: 16px;
      text-align: left;
      border-bottom: 1px solid #e9ecef;
    }

    th {
      background-color: var(--primary);
      color: var(--white);
      font-weight: 500;
      text-transform: uppercase;
      font-size: 14px;
      letter-spacing: 0.5px;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tbody tr {
      transition: background-color 0.3s ease;
    }

    tbody tr:hover {
      background-color: #f8f9fa;
    }

    td {
      color: #2c3e50;
      font-size: 15px;
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }

      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }

      th, td {
        padding: 12px 16px;
      }

      button {
        width: 100%;
      }
    }
    .btn-same-size {
    width: 120px; /* You can adjust this value */
  }
  </style>
</head>
<body>
    
<?php
$sql="SELECT * FROM inquiry WHERE userid != '$adminid' AND status='Pending'";
$res=$conn->query($sql);

?>
  <div class="container">
    <h2>User Inquiries</h2>

    <!-- Textarea for Admin Note -->
     <form action="inquiry.php" method="post">
    <label for="answer">Answer:</label>
    <input type="hidden" name="adminid" value="<?= htmlspecialchars($adminid) ; ?>">
    <textarea rows="5" name="answer" placeholder="Write here to answer the Questions..."></textarea>
    <div style="text-align:center">
       <a href="accepted.php" class="btn btn-primary ">Back</a>
      <button type="submit">Submit</button>
    </div>
   
    </form>
    <!-- Questions Table -->
    <table>
      <thead>
        <tr>
            <th>#</th>
            <th>From</th>
          <th>Question</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $t=0;
while($row=$res->fetch_assoc()){
    $t++;
          $question = $row['content'];
          $date = $row['date'];
          $userid = $row['userid'];
          $questid=$row['id'];
            $sql1 = "SELECT * FROM user WHERE id='$userid'";
            $res1 = $conn->query($sql1);
            $row1 = $res1->fetch_assoc();
            $name = $row1['fname'] . " " . $row1['lname'];
        ?>
        <tr>
            <td><?= $t ; ?></td>
            <td><?= $name ; ?></td>
          <td><?= $question ; ?></td>
          <td><?= $date ; ?></td>
          <form action="updateInquiry.php" method="post">
            <input type="hidden" name="questid" value="<?= htmlspecialchars($questid) ; ?>">
          <td><button type="submit">Done</button></td>
          </form>
        </tr>
      </tbody>
      <?php
        }
        ?>
    </table>
  </div>

  <?php
}
  ?>
</body>
</html>
