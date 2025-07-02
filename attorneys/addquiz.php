<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['manager'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm - Case Management</title>
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

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/attindex.css" rel="stylesheet">

   <style>
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
    width: 90%; /* increased from 60% */
    max-width: 600px; /* optional: prevents it from being too wide on large screens */
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

.button-container {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}

.btn-primary,
.btn-danger,
.btn-black {
    border-radius: 8px !important;
    padding: 8px 16px !important;
    font-weight: 500;
}

.btn-black {
    background-color: #222 !important;
    color: #fff;
    border: none;
}

.btn-black:hover {
    background-color: #000 !important;
}

.text-center button i {
    margin-right: 5px;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .quiz-container {
        width: 95%;
        height: auto;
        top: 10%;
        transform: translate(-50%, 0);
        padding: 20px;
    }

    .quiz-table input[type="text"] {
        width: 90%;
    }
}
</style>
    
</head>
<body>
    
<?php
include 'headerM.php';

$quizid=$_GET['id'];

$sql="SELECT * FROM `question` where quizid='$quizid'";
$res=$conn->query($sql);
if($res->num_rows == 0){
    ?>
<br><br>
    <div style="text-align: center;">
        <h1>Insert The Application Questions</h1>
    </div>
<div class="container quiz-container">
    <form action="quizProcess.php" method="post">
        <div id="quizWrapper">
            <div class="quiz-card">
                <h2 class="quiz-header">1st Question</h2>
                
                <table class="quiz-table">
                    <tr>
                        <th>Question</th>
                        <td><input type="text" name="question[]" required></td>
                        <input type="hidden" name="quizid" value="<?php echo $quizid; ?>">
                    </tr>
                    <tr>
                        <th>Grade</th>
                        <td><input type="text" name="answer[]" required></td>
                    </tr>
                </table>

                <div class="button-container">
                    <button type="button" class="btn btn-primary addQuestion">Add Question</button>
                    <button type="button" class="btn btn-danger removeQuestion">Remove Question</button>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-black">
                <i class="fas fa-save mr-2"></i> SUBMIT QUIZ
            </button>
        </div>
    </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let counter = 1;

    updateQuizHeaders();

    document.getElementById("quizWrapper").addEventListener("click", function (event) {
        if (event.target.classList.contains("addQuestion")) {
            let wrapper = document.getElementById("quizWrapper");
            let newQuiz = wrapper.firstElementChild.cloneNode(true);

            // Clear input values
            newQuiz.querySelector("input[name='question[]']").value = "";
            newQuiz.querySelector("input[name='answer[]']").value = "";

            // Update counter and header
            counter++;
            newQuiz.querySelector(".quiz-header").textContent = counter + getOrdinal(counter) + " Question";

            wrapper.appendChild(newQuiz);
            updateQuizHeaders();
        }

        if (event.target.classList.contains("removeQuestion")) {
            let wrapper = document.getElementById("quizWrapper");
            if (wrapper.children.length > 1) {
                event.target.closest(".quiz-card").remove();
                counter--;
                updateQuizHeaders();
            }
        }
    });

    function updateQuizHeaders() {
        let quizCards = document.querySelectorAll(".quiz-card");
        quizCards.forEach((card, index) => {
            card.querySelector(".quiz-header").textContent = (index + 1) + getOrdinal(index + 1) + " Question";
        });
    }

    function getOrdinal(n) {
        let suffixes = ["th", "st", "nd", "rd"];
        let v = n % 100;
        return suffixes[(v - 20) % 10] || suffixes[v] || suffixes[0];
    }
});
</script>

<?php
} else {
?>
    <br><br>
    <div style="text-align: center;">
        <h1>Quiz Already Created</h1>
    </div>

    <div class="container quiz-container">
        <form action="quizProcess.php" method="post">
            <div id="quizWrapper">
                <?php
                $counter = 1;
                while ($row = $res->fetch_assoc()) {
                    $question = $row['given'];
                    $grade = $row['grade'];
                ?>
                <div class="quiz-card">
                   
                    <table class="quiz-table">
                        <tr>
                            <th>Question</th>
                            <td><input type="text" name="question[]" value="<?= htmlspecialchars($question); ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Grade</th>
                            <td><input type="text" name="answer[]" value="<?= htmlspecialchars($grade); ?>" readonly></td>
                        </tr>
                    </table>
                </div>
                <?php } ?>
            </div>
            <!-- Optional: Submit button -->
            <!-- <button type="submit" class="btn btn-success">Submit Quiz</button> -->
        </form>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="applicants.php?id=<?= $quizid; ?>" class="btn btn-primary btn-action">
            <i class="fas fa-file-contract mr-1"></i> Back
        </a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let counter = document.querySelectorAll(".quiz-card").length;

            function updateQuizHeaders() {
                let quizCards = document.querySelectorAll(".quiz-card");
                quizCards.forEach((card, index) => {
                    card.querySelector(".quiz-header").textContent = (index + 1) + getOrdinal(index + 1) + " Question";
                });
            }

            function getOrdinal(n) {
                let suffixes = ["th", "st", "nd", "rd"];
                let v = n % 100;
                return suffixes[(v - 20) % 10] || suffixes[v] || suffixes[0];
            }

            updateQuizHeaders();
        });
    </script>
<?php } ?>


