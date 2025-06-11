<?php
require 'attorneys/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['user'])) {
    $email = $_SESSION['user']['email'];
    $id = $_SESSION['user']['id'];
    $fullName = $_SESSION['user']['fullName'];

    $code = sprintf('%06d', mt_rand(0, 999999));
    include "db.php";
    $query = "INSERT INTO verification_code VALUES (NULL,$code,(NOW() + INTERVAL 3 HOUR),$id)";
    $conn->query($query);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thefirm.contact.leb@gmail.com';
        $mail->Password = 'pisf wxyl nlao xcid';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('thefirm.contact.leb@gmail.com', 'The Firm');
        $mail->addAddress($email, $fullName);

        $mail->isHTML(true);
        $mail->Subject = 'Verification Code Request';
        $mail->Body = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Verification Code - TheFirm</title>
    <style>
        body {
            font-family: "Montserrat", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .email-header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }
        .email-body {
            padding: 20px;
        }
        .verification-code {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            font-size: 24px;
            letter-spacing: 3px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>TheFirm</h1>
        </div>
        <div class="email-body">
            <h2>Verification Code</h2>
            <p>Hello,</p>
            <p>Here is your verification code:</p>
            
            <div class="verification-code">
                ' . $code . '
            </div>
            
            <p>This code will expire in 3 hours.</p>
            <p>If you did not request this code, please ignore this email.</p>
            
            <p>Best regards,<br>TheFirm Team</p>
        </div>
    </div>
</body>
</html>';
        $mail->AltBody = "Hello " . $fullName . ",\n\nHere is your verification code: " . $code . "\n\nThis code will expire in 3 hours.\n\nIf you did not request this code, please ignore this email.\n\nBest regards.";

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'failed to send code.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}
