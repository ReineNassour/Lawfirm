<?php
include '../db.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname . ' ' . $lname;
    $email = $_POST['email'];
    $adname = $_POST['adname'];

    $sql1 = "UPDATE cv SET status='Rejected' WHERE userid='$userid'";
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
$mail->Subject = 'Missed Examination Notification';

$mail->Body = '
    <div style="font-family: Arial, sans-serif; padding: 20px; color: #333; line-height: 1.6;">
        <p>Dear <strong>' . htmlspecialchars($name) . '</strong>,</p>

        <p>We hope this message finds you well.</p>

        <p>We regret to inform you that our records indicate you were absent during the scheduled examination.</p>

        <p>We understand that unforeseen circumstances may arise, and if there was a valid reason for your absence, we kindly encourage you to communicate with the Academic Office at your earliest convenience to discuss possible next steps or documentation requirements.</p>

        <p>Please note that failure to provide a valid justification may result in a recorded absence without remediation options.</p>

        <br>
        <p>Yours sincerely,<br>
        <strong>' . htmlspecialchars($adname) . '</strong><br>
        Academic Administrator<br>
        <span style="color: #555;">TheFirm</span></p>
    </div>
';

$mail->AltBody = "Dear $name,\n\nWe regret to inform you that you were marked absent from the scheduled examination.\n\nIf you have a valid reason, please contact the Academic Office as soon as possible. Otherwise, this may be recorded as a non-remediable absence.\n\nYours sincerely,\n$adname\nAcademic Administrator\nTheFirm";

$mail->send();

            
            header("location: accepted.php");
         
            
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
?>
