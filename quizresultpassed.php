<?php
include 'db.php';

$quizId = $_GET['id'];

$sql1="SELECT * FROM quizresult WHERE id='$quizId'";
$result1=$conn->query($sql1);
$row1=$result1->fetch_assoc();
$userId=$row1['userid'];

$sql2="SELECT * FROM `cv` where userid='$userId'";
$result2=$conn->query($sql2);
$row2=$result2->fetch_assoc();
$description=$row2['description'];
$specialized=$row2['specialized'];

    $sql = "UPDATE `user` SET role=2 WHERE id='$userId'";
    $result = $conn->query($sql);

    $sql3="INSERT INTO `attorneys` (userid,description,specialized) VALUES ('$userId','$description','$specialized')";
    $result3=$conn->query($sql3);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Graduation Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow: hidden;
            margin: 0;
            height: 100vh;
            position: relative;
        }

        .congratulations-div {
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

        .congratulations-div h3 {
            font-size: 2rem;
            color: green;
        }

        .congratulations-div p {
            font-size: 1.2rem;
            color: #333;
        }

        .party-popper {
            position: absolute;
            font-size: 70px;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 25px;
            opacity: 1;
            animation: confettiFall 6s infinite;
            border-radius: 5px;
        }

        @keyframes confettiFall {
            0% { transform: translate(0, 0) rotate(0deg); opacity: 1; }
            25% { transform: translate(80px, -80px) rotate(90deg); opacity: 1; }
            50% { transform: translate(0, -160px) rotate(180deg); opacity: 0.8; }
            75% { transform: translate(-80px, -80px) rotate(270deg); opacity: 1; }
            100% { transform: translate(0, 0) rotate(360deg); opacity: 1; }
        }

        .confetti:nth-child(odd) { animation-duration: 3s; }
        .confetti:nth-child(even) { animation-duration: 4s; animation-delay: 0.5s; }

        .back-link { text-decoration: none; }
        .back-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover { background-color: #218838; }
    </style>
</head>
<body>

<div id="congratulationsDiv" class="congratulations-div">
    <a href="index.php" class="back-link">
        <button class="back-button">Back</button>
    </a><br><br>

    <h3>🎓 Congratulations, Partner! 🎓</h3>
    <p>You've officially passed the exam and earned your place as a partner at <strong>The Firm</strong>.</p>
    <h5>We are proud to have you on the team.</h5>
    <a href="newattContract.php?id=<?= $userId ; ?>" class="back-link">
        <button class="back-button">View Contract</button>
    </a>
</div>

<div class="party-popper">🎉</div>

<?php
for ($i = 0; $i < 60; $i++) {
    echo "<div class='confetti' style='top: " . rand(10, 90) . "%; left: " . rand(5, 95) . "%; background-color: hsl(" . rand(0, 360) . ", 100%, 70%);'></div>";
}
?>

<script>
    setTimeout(function() {
        const confetti = document.querySelectorAll('.confetti');
        confetti.forEach(function(piece) {
            piece.style.animationPlayState = 'paused';
        });
    }, 70000);
</script>

</body>
</html>
