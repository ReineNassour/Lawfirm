<?php
ob_start();
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    $emails = $_POST['email']; 
    $emailList = explode("\n", trim($emails)); 
    $sendemail = $_POST['sendemail'];
    $name= $_POST['attname'];

    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug = 2; 
        $mail->Debugoutput = 'html';

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thefirm.contact.leb@gmail.com';
        $mail->Password = 'pisf wxyl nlao xcid';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('thefirm.contact.leb@gmail.com', 'The Firm'); 

        // Add multiple recipients
        foreach ($emailList as $email) {
            $email = trim($email); 
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($email); 
            } else {
                error_log("Invalid email address: $email"); 
            }
        }

        $mail->isHTML(true);
$mail->Subject = 'The Firm - About Your Case';

$mail->Body = '
    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; color: #333;">
        <div style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <p style="font-size: 16px; line-height: 1.6;">
                '.nl2br(htmlspecialchars($sendemail)).'
            </p>
            <br>
            <p style="font-size: 16px; line-height: 1.6;">
    Best regards,<br>
    <strong>The Attorney '.$name.'</strong><br>
    TheFirm.
</p>
        </div>
    </div>';


$mail->AltBody ='
    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; color: #333;">
        <div style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <p style="font-size: 16px; line-height: 1.6;">
                '.nl2br(htmlspecialchars($sendemail)).'
            </p>
            <br>
            <p style="font-size: 16px; line-height: 1.6;">
    Best regards,<br>
    <strong>The Attorney '.$name.'</strong><br>
    TheFirm.
</p>
        </div>
    </div>';

        $mail->send();
        
        header("Location: accepted.php");
        exit();

    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        echo "Message could not be sent. Please check the logs for more information.";
    }
    ob_end_flush();
}
