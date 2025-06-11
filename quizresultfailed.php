<?php
include 'db.php';

$quizId = $_GET['id'];

$sql1="SELECT * FROM quizresult WHERE id='$quizId'";
$result1=$conn->query($sql1);
$row1=$result1->fetch_assoc();
$userId=$row1['userid'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
            overflow: hidden;
            margin: 0;
            height: 100vh;
            position: relative;
        }

        .sad-div {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }

        .sad-div h3 {
            font-size: 2rem;
            color: #dc3545;
        }

        .sad-div p {
            font-size: 1.2rem;
            color: #555;
        }

        .sad-face {
            position: absolute;
            font-size: 70px;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
        }

        .rain {
            position: absolute;
            width: 2px;
            height: 20px;
            background-color: #3498db;
            opacity: 0.6;
            animation: rainFall 1.5s linear infinite;
        }

        @keyframes rainFall {
            0% { transform: translateY(-100px); opacity: 0.7; }
            100% { transform: translateY(100vh); opacity: 0; }
        }

        .back-link { text-decoration: none; }
        .back-button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover { background-color: #5a6268; }
    </style>
</head>
<body>

<div id="sadDiv" class="sad-div">
    <a href="index.php" class="back-link">
        <button class="back-button">Back</button>
    </a><br><br>

    <h3>😞 Unfortunately, You Didn't Pass The Exam</h3>
    <p>We're sorry to inform you that you didn't qualify to become a partner at <strong>The Firm</strong> at this time.</p>
    <h5>Don't give up. You can try again and come back stronger!</h5>
</div>

<div class="sad-face">☔</div>

<?php
for ($i = 0; $i < 60; $i++) {
    echo "<div class='rain' style='top: " . rand(0, 100) . "vh; left: " . rand(0, 100) . "vw;'></div>";
}
?>

</body>
</html>
