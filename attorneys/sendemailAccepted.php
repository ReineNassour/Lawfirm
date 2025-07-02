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
    
                $sql1 = "UPDATE `case` SET status='Accepted' WHERE id='$caseid'";

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
$mail->Subject = 'Your Case Has Been Accepted - Here`s What`s Next';

$mail->Body = '
    <div style="background-color: #f0f2f5; padding: 50px 20px; font-family: Helvetica, Arial, sans-serif;">
        <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 40px; border-radius: 10px; border: 1px solid #e3e6ea;">
            
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="margin: 0; color: #1a1a1a;">Your Case Has Been Accepted</h2>
                <p style="margin: 5px 0; color: #6b6b6b; font-size: 15px;">Thank you for choosing <strong>TheFirm</strong></p>
            </div>

            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                Dear <strong>' . htmlspecialchars($name) . '</strong>,
            </p>

            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                We`re pleased to inform you that your case has been <strong>formally accepted</strong> by our legal team at <strong>TheFirm</strong>.
                After carefully reviewing the information you submitted, we believe your case meets the criteria for further action.
            </p>

            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                You can now access the <strong>“Track Your Case”</strong> dashboard to monitor developments, communicate with your assigned attorney, and review important documents.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="https://yourdomain.com/track-case" style="background-color: #0077cc; color: #ffffff; text-decoration: none; padding: 12px 30px; border-radius: 6px; font-weight: bold; font-size: 16px;">Track Your Case</a>
            </div>

            <p style="font-size: 16px; color: #333333; line-height: 1.6;">
                If you have any questions, feel free to reach out at any time via your secure client portal.
            </p>

            <p style="margin-top: 40px; font-size: 16px; color: #333333;">
                Sincerely,<br>
                <strong>' . htmlspecialchars($attname) . '</strong><br>
                Legal Administrator<br>
                <span style="color: #888888;">TheFirm</span>
            </p>
        </div>
    </div>
';

$mail->AltBody = "Dear $name,\n\nYour case has been officially accepted by TheFirm.\n\nYou may now track your case and communicate with your legal team through the dashboard.\n\nBest regards,\n$attname\nLegal Administrator\nTheFirm";

$mail->send();

    header("Location: accepted.php");
    exit();

} catch (Exception $e) {
    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}

   
}
}
