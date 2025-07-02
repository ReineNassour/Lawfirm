<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['attorney']['id'])) {
    header('location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheFirm – Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Law Firm Case Management">
    <meta name="description" content="Case Management System for Law Firms">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/admincss.css" rel="stylesheet">

    <style>
        .payment-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .payment-header {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .payment-table th {
            width: 120px;
            vertical-align: middle;
            font-weight: 500;
            padding: 8px;
        }

        .payment-table td {
            padding: 8px;
        }

        .payment-table input {
            width: 100%;
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-container {
            text-align: right;
            margin-top: 15px;
        }

        .btn-black {
            background-color: #222;
            color: #fff;
            border: none;
        }

        .btn-black:hover {
            background-color: #000;
        }

        @media (max-width: 768px) {
            .payment-table th,
            .payment-table td {
                display: block;
                width: 100%;
            }
        }

        @media print {
            .no-print,
            button,
            a.btn {
                display: none !important;
            }

            .payment-card {
                box-shadow: none !important;
                border: none !important;
            }

            .payment-container {
                display: block;
            }

            .btn-success {
                display: inline-block !important;
            }
        }
    </style>
</head>

<body>

<?php

$id = $_GET['id'];

$sql1 = "SELECT * FROM `ccontract` WHERE id='$id'";
$res1 = $conn->query($sql1);
$row1 = $res1->fetch_assoc();
$caseid = $row1['caseid'];

$sql3 = "SELECT * FROM `case` WHERE id='$caseid'";
$res3 = $conn->query($sql3);
$row3 = $res3->fetch_assoc();
$userid = $row3['userid'];

$sql4 = "SELECT * FROM `user` WHERE id='$userid'";
$res4 = $conn->query($sql4);
$row4 = $res4->fetch_assoc();
$email = $row4['email'];
$fname = $row4['fname'];
$lname = $row4['lname'];
?>
<br>

<h1 class="text-center mb-4">Payment Bill For: <?= $fname . " " . $lname; ?></h1>

<?php
$sql9 = "SELECT * FROM `payments` WHERE ccontractid='$id'";
$res9 = $conn->query($sql9);
if ($res9->num_rows == 0) {
?>

<div class="container payment-container py-4">
    <form action="paycontractProcess.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">

        <div id="paymentWrapper">
            <div class="payment-card">
                <h2 class="payment-header">1st Payment Details</h2>

                <table class="payment-table">
                    <tr>
                        <th>Payment</th>
                        <td><input type="number" name="pay[]" required></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><input type="text" name="date[]" required></td>
                    </tr>
                </table>

                <div class="button-container">
                    <button type="button" class="btn btn-primary addPayment">Add Payment</button>
                    <button type="button" class="btn btn-danger removePayment">Remove Payment</button>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-black">
                <i class="fas fa-save mr-2"></i> SUBMIT
            </button>
        </div>
    </form>
</div>

<?php
} else {
    while ($row9 = $res9->fetch_assoc()) {
        $status = $row9['status'];
        $payid = $row9['id'];
        $payment = $row9['amount'];
?>

<div class="container payment-container py-4">
    <?php include 'db.php'; ?>
    <form action="paycontractProcess.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">

        <div id="paymentWrapper">
            <div class="payment-card">
                <h2 class="payment-header">Case Payment Details</h2>

                <table class="payment-table">
                    <tr>
                        <th>Payment</th>
                        <td><input type="text" name="pay[]" placeholder="<?= $payment . " $" ; ?>" required></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><input type="text" name="date[]" placeholder="<?= $row9['date'] ; ?>" required></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            if ($status == "UnPaid") {
                                echo '<span class="badge badge-warning">UnPaid</span>';
                            } else if ($status == "Paid") {
                                echo '<span class="badge badge-success">Paid</span>';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>

<?php
    }
}
?>

<div class="text-center mb-4 no-print">
    <a href="contract.php?id=<?= $caseid; ?>" class="btn btn-primary btn-action">
        <i class="fas fa-file-contract mr-1"></i> Back
    </a>
    <button type="button" class="btn btn-primary" onclick="window.print()">
        <i class="fas fa-print mr-2"></i> Print
    </button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let counter = 1;

    updatePaymentHeaders();

    document.getElementById("paymentWrapper").addEventListener("click", function (event) {
        if (event.target.classList.contains("addPayment")) {
            let wrapper = document.getElementById("paymentWrapper");
            let newPayment = wrapper.firstElementChild.cloneNode(true);

            newPayment.querySelector("input[name='pay[]']").value = "";
            newPayment.querySelector("input[name='date[]']").value = "";

            counter++;
            newPayment.querySelector(".payment-header").textContent = counter + getOrdinal(counter) + " Payment Details";

            wrapper.appendChild(newPayment);
            updatePaymentHeaders();
        }

        if (event.target.classList.contains("removePayment")) {
            let wrapper = document.getElementById("paymentWrapper");
            if (wrapper.children.length > 1) {
                event.target.closest(".payment-card").remove();
                counter--;
                updatePaymentHeaders();
            }
        }
    });

    function updatePaymentHeaders() {
        let paymentCards = document.querySelectorAll(".payment-card");
        paymentCards.forEach((card, index) => {
            card.querySelector(".payment-header").textContent = (index + 1) + getOrdinal(index + 1) + " Payment Details";
        });
    }

    function getOrdinal(n) {
        let suffixes = ["th", "st", "nd", "rd"];
        let v = n % 100;
        return suffixes[(v - 20) % 10] || suffixes[v] || suffixes[0];
    }
});
</script>

</body>
</html>
