<?php
include '../db.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $userid = $_POST['userid'];
    $adname = $_POST['adname'];
    $cvid= $_POST['cvid'];

    $sql1 = "UPDATE cv SET status='Accepted' WHERE id='$cvid'";
    if ($conn->query($sql1)) {
       

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // or 3 for more details
        $mail->Debugoutput = 'html';

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thefirm.contact.leb@gmail.com';
        $mail->Password = 'pisf wxyl nlao xcid';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('thefirm.contact.leb@gmail.com', 'The Firm');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
$mail->Subject = 'CV Accepted - Next Steps';

$mail->Body = '
    <div style="font-family: Arial, sans-serif; padding: 20px; color: #333; line-height: 1.6;">
        <p>Dear <strong>' . htmlspecialchars($name) . '</strong>,</p>

        <p>We are pleased to inform you that your CV has been <strong>accepted</strong>. We were impressed with your background and qualifications.</p>

        <p>As a next step, we will be scheduling a <strong>Zoom meeting</strong> with you shortly to discuss further details. You will receive an invitation with the date and time soon.</p>

        <p>Thank you for your interest, and we look forward to speaking with you.</p>

        <br>
        <p>Best regards,<br>
        <strong>' . htmlspecialchars($adname) . ',</strong><br>
         Legal Administrator,<br>
        <span style="color: #555;">TheFirm.</span></p>
    </div>
';

$mail->AltBody = "Dear $name,\n\nWe are pleased to inform you that your CV has been accepted. We were impressed with your background and qualifications.\n\nA Zoom meeting will be scheduled soon to discuss further details. 
You'll receive the invitation shortly.\n\nBest regards,\n$adname\nLegal Administrator,\nTheFirm";


        $mail->send();

        header("Location: accepted.php");
       
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
   
}
}
