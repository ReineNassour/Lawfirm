<?php
session_start();
include 'checkStatus.php';
include 'header.php';

if (!isset($_SESSION['user']['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Case Studies</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm, Legal Services, Attorneys, Case Studies" name="keywords">
    <meta content="Browse our successful case studies and legal work" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    
    <link href="css/cases.css" rel="stylesheet">
</head>
<style>
.quiz-table input[readonly] {
    border: none;
    background-color: transparent;
    font-weight: 600;
    color: #222;
    box-shadow: none;
    cursor: default;
}

.btn-black {
    background-color: #111 !important;
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 12px 28px;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

.btn-black:hover {
    background-color: #000 !important;
}

.btn-black i {
    transition: transform 0.3s ease;
}

.btn-black:hover i {
    transform: scale(1.2);
}

.quiz-card {
    transition: transform 0.2s ease, box-shadow 0.3s ease;
}

.quiz-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

@media (max-width: 576px) {
    .quiz-container {
        padding: 15px;
    }

    .quiz-table th, .quiz-table td {
        display: block;
        width: 100%;
        text-align: left !important;
        padding: 5px 0;
    }

    .quiz-table input[type="text"] {
        width: 100%;
    }
}





      .page-header {
    height: 150px;
    display: flex;
    align-items: center; 
    justify-content: center; 
    padding: 20px 0;
}

body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .quiz-container {
            width: 70%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-radius: 15px;
        }

        .quiz-card {
            border: 1px solid #e3e3e3;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #fdfdfd;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .quiz-header {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
            text-align: center;
        }

        .quiz-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .quiz-table th {
            text-align: right;
            width: 30%;
            padding-right: 15px;
            color: #555;
            font-weight: 500;
        }

        .quiz-table td {
            text-align: left;
        }

        .quiz-table input[type="text"] {
            width: 90%;
            max-width: 600px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
            transition: border-color 0.3s;
            display: block;
            margin: 0 auto;
        }

        .quiz-table input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-black {
            background-color: #222 !important;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .btn-black:hover {
            background-color: #000 !important;
        }

        .text-center button i {
            margin-right: 5px;
        }

        @media (max-width: 768px) {
            .quiz-container {
                width: 95%;
                padding: 20px;
            }

            .quiz-table input[type="text"] {
                width: 90%;
            }
        }


        .chatbot-box {
  width: 100%;
  max-width: 600px;
  margin: 20px auto;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #f9f9f9;
  padding: 10px;
  font-family: Arial, sans-serif;
}

.chat-message {
  padding: 10px;
  margin: 5px 0;
  border-radius: 8px;
  max-width: 80%;
}

.chat-message.user {
  background-color: #cce5ff;
  text-align: right;
  margin-left: auto;
}

.chat-message.bot {
  background-color: #e2e3e5;
  text-align: left;
  margin-right: auto;
}

.ask-button {
  margin-top: 10px;
  padding: 8px 12px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

</style>
<body>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
           
        </div>
    </div>


    <?php
$quizid = $_GET['id'];


$sql3 = "SELECT * FROM `quiz` WHERE id='$quizid'";
$res3 = $conn->query($sql3);
$row3 = $res3->fetch_assoc();
$quizdate = $row3['date'];
$quizstarttime = $row3['starttime'];
$quizendtime = $row3['endtime'];

$quizStartDateTime = strtotime($quizdate . ' ' . $quizstarttime);
$quizEndDateTime = strtotime($quizdate . ' ' . $quizendtime);

$currentDateTime = time();

if ($currentDateTime >= $quizStartDateTime && $currentDateTime <= $quizEndDateTime) {
    // Quiz is in progress
    $remainingTime = $quizEndDateTime - $currentDateTime; // Remaining time in seconds
    $remainingHours = floor($remainingTime / 3600); // Convert seconds to hours
    $remainingMinutes = floor(($remainingTime % 3600) / 60); // Convert remaining seconds to minutes

    $sql = "SELECT * FROM `question` WHERE quizid='$quizid'";
    $res = $conn->query($sql);
?>

    <div style="text-align: center; margin-top: 40px;">
        <h1>Insert The Application Answers</h1>
        <?php
    echo "There are approximately " . $remainingHours . " hour(s) and " . $remainingMinutes . " minute(s) remaining until the examination concludes.";
        ?>

    </div>

    <div class="container quiz-container">
        <form action="quizProcess.php" method="post">
            <div id="quizWrapper">
                 <?php
               $counter = 1;
               while ($row = $res->fetch_assoc()):
                   $question = $row['given'];
                   $questid = $row['id'];
               ?>
                   <div class="quiz-card">
                       <h2 class="quiz-header"><?= $counter . getOrdinalSuffix($counter); ?> Question</h2>
                       <table class="quiz-table">
                           <tr>
                               <th>Question</th>
                               <?php  $userid = $_SESSION['user']['id']; ?>
                               <td><input type="text" name="question[]" placeholder="<?= htmlspecialchars($question); ?>" readonly></td>
                               <input type="hidden" name="questid[]" value="<?= $questid; ?>">
                               <input type="hidden" name="userid[]" value="<?= $userid; ?>">
                           </tr>
                           <tr>
                               <th>Answer</th>
                               <td><input type="text" name="answer[]" required></td>
                           </tr>
                       </table>
               
                     
                   </div>
               <?php
                   $counter++;
               endwhile;
                ?>               
                        </table>
                    </div>
            


            <div class="text-center mt-4">
                <button type="submit" class="btn btn-black">
                    <i class="fas fa-save"></i> SUBMIT QUIZ
                </button>
            </div>
        </form>
    </div>
<?php
} elseif ($currentDateTime < $quizStartDateTime) {
    // Quiz hasn't started yet
?>
    <br><br>
    <div style="text-align: center;">
        <h1>Soon</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="application-message text-center mt-4">
                <i class="fas fa-hourglass-half fa-3x mb-3"></i>
                <h1>You will be able to view your exam on the scheduled date.</h1>
                <a href="application.php" class="btn btn-success mt-3">Back</a>
            </div>
        </div>
    </div>
<?php
} elseif ($currentDateTime > $quizEndDateTime) {

    $updateStatusSql = "UPDATE `quiz` SET status = 'Finished' WHERE id = '$quizid'";
    $conn->query($updateStatusSql); 

    ?>
    <br><br>
    <div style="text-align: center;">
        <h1>The Exam Has Officially Ended.</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="application-message text-center mt-4">
                <i class="fas fa-hourglass-half fa-3x mb-3"></i>
                <h1>Please Wait For Another Exam Soon</h1>
                <a href="application.php" class="btn btn-success mt-3">Back</a>
            </div>
        </div>
    </div>
<?php
} 
?>

<br><br>
<?php
function getOrdinalSuffix($number) {
    if (!in_array(($number % 100), [11, 12, 13])) {
        switch ($number % 10) {
            case 1: return "st";
            case 2: return "nd";
            case 3: return "rd";
        }
    }
    return "th";
}
?>

  
<script>
function askChatbot(questionId) {
    const chatbox = document.getElementById("chatbox-" + questionId);
    chatbox.innerHTML = "<div class='chat-message bot'>⏳ Asking the chatbot...</div>";

    fetch("ask_chatbot.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "questid=" + questionId
    })
    .then(res => res.text())
    .then(data => {
        chatbox.innerHTML += "<div class='chat-message bot'>" + data + "</div>";
    });
}

    </script>

<?php include 'footer.php'; ?>
</body>
</html>
