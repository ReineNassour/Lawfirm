<?php
include '../db.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $attname= $_POST['attname'];
$caseid = $_POST['caseid'];
    
                $sql1 = "UPDATE `case` SET status='Rejected' WHERE id='$caseid'";

            if ($conn->query($sql1)) {
           
    
    $mail = new PHPMailer(true);
   $mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // Disable debug output
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thefirm.contact.leb@gmail.com';
    $mail->Password = 'pisf wxyl nlao xcid';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('thefirm.contact.leb@gmail.com', 'The Firm');
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
$mail->Subject = 'Case Decision - Not Accepted';

$mail->Body = '
    <div style="font-family: Arial, sans-serif; padding: 20px; color: #333; line-height: 1.6;">
        <p>Dear <strong>' . htmlspecialchars($name) . '</strong>,</p>
        <p>Thank you for submitting your case to <strong>TheFirm</strong>.</p>
        <p>After careful review by our legal team, we regret to inform you that we will not be proceeding with your case at this time.</p>
        <p>Please know this decision does not reflect the importance of your situation, but rather aligns with our internal criteria and current capacity.</p>
        <p>We appreciate your trust in TheFirm and encourage you to seek assistance from other qualified legal resources if needed.</p>
        <br>
        <p>Best regards,<br>
        <strong>' . htmlspecialchars($attname) . '</strong><br>
        Legal Administrator<br>
        <span style="color: #555;">TheFirm</span></p>
    </div>
';

$mail->AltBody = "Dear $name,\n\nThank you for submitting your case to TheFirm.\n\nAfter careful review, we regret to inform you that we will not be proceeding with your case at this time.\n\nThis decision reflects our internal criteria and current capacity.\n\nWe appreciate your trust and encourage you to seek other legal assistance.\n\nBest regards,\n$attname\nLegal Administrator\nTheFirm";

$mail->send();

header("Location: rejected.php");
exit();

} catch (Exception $e) {
    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}

   
}
}
