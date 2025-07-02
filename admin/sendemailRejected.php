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
    $cvid = $_POST['cvid'];

    // Update the CV status to 'Rejected' in the database
    $sql1 = "UPDATE cv SET status='Rejected' WHERE id='$cvid'";
    if ($conn->query($sql1)) {
        // Send the rejection email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0; 
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
            $mail->Subject = 'Application Update - Thank You for Applying';

            $mail->Body = '
                <div style="font-family: Arial, sans-serif; padding: 20px; color: #333; line-height: 1.6;">
                    <p>Dear <strong>' . htmlspecialchars($name) . '</strong>,</p>

                    <p>Thank you for taking the time to apply to TheFirm. We appreciate your interest and the effort you put into your application.</p>

                    <p>After careful consideration, we regret to inform you that your application has not been selected to move forward in the process at this time.</p>

                    <p>We encourage you to apply again in the future should a position better match your experience and interests.</p>

                    <br>
                    <p>Best regards,<br>
                    <strong>' . htmlspecialchars($adname) . ',</strong><br>
                    Legal Administrator,<br>
                    <span style="color: #555;">TheFirm.</span></p>
                </div>
            ';
            
            $mail->AltBody = "Dear $name,\n\nThank you for applying to TheFirm. After careful review, we regret to inform you that your application has not been selected to move forward at this time.\n\nWe appreciate your interest and encourage you to apply again in the future.\n\nBest regards,\n$adname\nLegal Administrator,\nTheFirm";

            $mail->send();
            
         header("location: rejected.php");
            
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
?>
