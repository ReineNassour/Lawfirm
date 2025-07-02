<?php
session_start();
include '../db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
$adname=$_SESSION['admin']['fullName'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm | Exam Review</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Law Firm Examination System" name="keywords">
    <meta content="Review and grade attorney exam responses" name="description">

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

    <style>
        .exam-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin: 40px auto;
            max-width: 900px;
        }

        .exam-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e9ecef;
        }

        .exam-header h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .exam-header p {
            color: #7f8c8d;
            margin-bottom: 0;
        }

        .candidate-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .candidate-info i {
            font-size: 2.5rem;
            color: #3498db;
            margin-right: 20px;
        }

        .candidate-info h2 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 0;
            font-weight: 600;
        }

        .candidate-info strong {
            color: #3498db;
        }

        .question-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #3498db;
        }

        .question-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
        }

        .question-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .question-title {
            font-size: 18px;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0;
        }

        .question-section {
            margin-bottom: 20px;
        }

        .question-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            display: block;
        }

        .question-content {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
        }

        textarea.form-control {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            resize: vertical;
            min-height: 100px;
            font-size: 15px;
            box-shadow: none;
            transition: border-color 0.3s;
        }

        textarea.form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .grade-input {
            position: relative;
        }

        .grade-input input {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            width: 100%;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .grade-input input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .grade-actions {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .btn-primary {
            background: #3498db;
            border-color: #3498db;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #7f8c8d;
            border-color: #7f8c8d;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #95a5a6;
            border-color: #95a5a6;
            transform: translateY(-2px);
        }

        .result-summary {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
        }

        .result-summary h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .result-summary .grade {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .result-summary .passed {
            color: #2ecc71;
        }

        .result-summary .failed {
            color: #e74c3c;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 30px 0;
        }

        .empty-state i {
            font-size: 3rem;
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .empty-state h2 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .empty-state p {
            color: #7f8c8d;
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto 20px;
        }

        @media (max-width: 768px) {
            .exam-container {
                padding: 25px;
                margin: 20px;
            }

            .candidate-info {
                flex-direction: column;
                text-align: center;
            }

            .candidate-info i {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .question-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .question-number {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <?php
    $userid = $_GET['id'];

    $sql4 = "SELECT * FROM `user` WHERE id='$userid'";
    $res4 = $conn->query($sql4);
    $row4 = $res4->fetch_assoc();
    $fname = $row4['fname'];
    $lname = $row4['lname'];
    $email = $row4['email'];

    $sql2 = "SELECT * FROM `quiz` ORDER BY id DESC LIMIT 1";
    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_assoc();
    $quizid = $row2['id'];
    $status = $row2['status'];

    if ($status == 'Pending') {
    ?>
        <div class="container py-5">
            <div class="empty-state">
                <i class="fas fa-hourglass-half"></i>
                <h2>Exam Not Yet Available for Review</h2>
                <p>This examination is still in progress. You'll be able to review and grade the responses once the exam period concludes.</p>
                <a href="accepted.php" class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i> Return to Applicants
                </a>
            </div>
        </div>
    <?php
        exit;
    } else {
        $sql = "SELECT * FROM `question` WHERE quizid='$quizid'";
        $res = $conn->query($sql);

        $sql3 = "SELECT * FROM `answers` WHERE userid='$userid'";
        $res3 = $conn->query($sql3);
    ?>

        <div class="container">
            <div class="exam-container">
                <div class="exam-header">
                    <h1>Exam Review & Grading</h1>
                    <p>Review and grade the candidate's examination responses</p>
                </div>

                <div class="candidate-info">
                    <i class="fas fa-user-graduate"></i>
                    <h2>Reviewing answers from <strong><?= htmlspecialchars($fname . " " . $lname); ?></strong></h2>
                </div>

                <?php
                if ($res3->num_rows > 0) {
                ?>
                    <form action="grade.php" method="post">
                        <?php
                        $counter = 1;
                        while ($row3 = $res3->fetch_assoc()) {
                            $answers = $row3['answer'];
                            $ansid = $row3['id'];
                            $grades = $row3['grade'];

                            $row = $res->fetch_assoc();
                            $question = $row['given'];
                            $grade = $row['grade'];
                            $questid = $row['id'];

                            if ($grades == 0) {
                        ?>
                                <div class="question-card">
                                    <div class="question-header">
                                        <div class="question-number"><?= $counter ?></div>
                                        <h3 class="question-title">Question <?= $counter . getOrdinalSuffix($counter) ?></h3>
                                    </div>

                                    <div class="question-section">
                                        <label class="question-label">Question</label>
                                        <div class="question-content">
                                            <?= nl2br(htmlspecialchars($question)); ?>
                                        </div>
                                        <input type="hidden" name="userid" value="<?= $userid; ?>">
                                        <input type="hidden" name="questid[]" value="<?= $questid; ?>">
                                    </div>

                                    <div class="question-section">
                                        <label class="question-label">Candidate's Answer</label>
                                        <div class="question-content">
                                            <?= nl2br(htmlspecialchars($answers)); ?>
                                        </div>
                                        <textarea name="answer[]" class="d-none"><?= htmlspecialchars($answers); ?></textarea>
                                        <textarea name="question[]" class="d-none"><?= htmlspecialchars($question); ?></textarea>
                                    </div>

                                    <div class="question-section">
                                        <label class="question-label">Assign Grade (out of <?= $grade; ?> points)</label>
                                        <div class="grade-input">
                                            <input type="number" name="grade[]" min="0" max="<?= $grade; ?>" placeholder="Enter grade..." required>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="question-card">
                                    <div class="question-header">
                                        <div class="question-number"><?= $counter ?></div>
                                        <h3 class="question-title">Question <?= $counter . getOrdinalSuffix($counter) ?></h3>
                                    </div>

                                    <div class="question-section">
                                        <label class="question-label">Question</label>
                                        <div class="question-content">
                                            <?= nl2br(htmlspecialchars($question)); ?>
                                        </div>
                                        <input type="hidden" name="userid" value="<?= $userid; ?>">
                                        <input type="hidden" name="questid[]" value="<?= $questid; ?>">
                                    </div>

                                    <div class="question-section">
                                        <label class="question-label">Candidate's Answer</label>
                                        <div class="question-content">
                                            <?= nl2br(htmlspecialchars($answers)); ?>
                                        </div>
                                        <textarea name="answer[]" class="d-none"><?= htmlspecialchars($answers); ?></textarea>
                                        <textarea name="question[]" class="d-none"><?= htmlspecialchars($question); ?></textarea>
                                    </div>

                                    <div class="question-section">
                                        <label class="question-label">Assigned Grade (out of <?= $grade; ?> points)</label>
                                        <div class="grade-input">
                                            <input type="number" name="grade[]" min="0" max="<?= $grade; ?>" value="<?= htmlspecialchars($grades); ?>" required>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            $counter++;
                        }

                        // Calculate and display total score if already graded
                        $sql6 = "SELECT SUM(grade) as sum FROM `answers` WHERE userid='$userid'";
                        $res6 = $conn->query($sql6);

                        if ($res6->num_rows > 0) {
                            $row6 = $res6->fetch_assoc();
                            $sum = $row6['sum'];

                            $sql7 = "SELECT grade FROM `question` WHERE quizid='$quizid'";
                            $res7 = $conn->query($sql7);
                            $totalPossible = 0;

                            while ($row7 = $res7->fetch_assoc()) {
                                $totalPossible += $row7['grade'];
                            }

                            $half = $totalPossible / 2;
                            $resultText = ($sum > $half) ? "PASSED" : "FAILED";
                            $resultClass = ($sum > $half) ? "passed" : "failed";

                            // Insert result into database if not already done
                            if ($sum > $half && $sum > 0) {
                                $checkSql = "SELECT * FROM `quizresult` WHERE userid='$userid' AND quizid='$quizid'";
                                $checkRes = $conn->query($checkSql);

                                if ($checkRes->num_rows == 0) {
                                    $sql8 = "INSERT INTO `quizresult` (score, result, quizid, userid) VALUES ('$sum', 'Passed', '$quizid', '$userid')";
                                    $conn->query($sql8);
                                }
                            } else if ($sum > 0) {
                                $checkSql = "SELECT * FROM `quizresult` WHERE userid='$userid' AND quizid='$quizid'";
                                $checkRes = $conn->query($checkSql);

                                if ($checkRes->num_rows == 0) {
                                    $sql8 = "INSERT INTO `quizresult` (score, result, quizid, userid) VALUES ('$sum', 'Failed', '$quizid', '$userid')";
                                    $conn->query($sql8);
                                }
                            }
                            ?>
                            <div class="result-summary">
                                <h2>Final Examination Result</h2>
                                <p class="grade">Score: <span class="<?= $resultClass ?>"><?= $sum ?></span> out of <?= $totalPossible ?> points - <span class="<?= $resultClass ?>"><?= $resultText ?></span></p>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="grade-actions">
                            <a href="accepted.php" class="btn btn-secondary mr-3">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Submit Grades
                            </button>
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <div class="empty-state">
                        <i class="fas fa-file-alt"></i>
                        <h2>No Answers Submitted</h2>
                        <p>This candidate has not yet provided any responses for the examination.</p>
                        <form action="noquizanswers.php" method="post">

                            <input type="hidden" name="userid" value="<?= $userid; ?>">
                            <input type="hidden" name="fname" value="<?= $fname; ?>">
                            <input type="hidden" name="lname" value="<?= $lname; ?>">
                            <input type="hidden" name="email" value="<?= $email; ?>">
                            <input type="hidden" name="adname" value="<?= $adname; ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-envelope mr-1"></i> Notify Candidate
                            </button>
                        <a href="accepted.php" class="btn btn-primary">
                            <i class="fas fa-arrow-left mr-2"></i> Return to Applicants
                        </a>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <?php include 'footer.php'; ?>

    <?php
    function getOrdinalSuffix($number)
    {
        if (!in_array(($number % 100), [11, 12, 13])) {
            switch ($number % 10) {
                case 1:
                    return "st";
                case 2:
                    return "nd";
                case 3:
                    return "rd";
            }
        }
        return "th";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to current page nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                if (currentLocation.includes(link.getAttribute('href'))) {
                    link.classList.add('active');
                }
            });

            // Validate grade inputs
            const gradeInputs = document.querySelectorAll('input[type="number"][name="grade[]"]');
            gradeInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const max = parseInt(this.getAttribute('max'));
                    const value = parseInt(this.value);

                    if (value < 0) {
                        this.value = 0;
                    } else if (value > max) {
                        this.value = max;
                    }
                });
            });
        });
    </script>
</body>

</html>