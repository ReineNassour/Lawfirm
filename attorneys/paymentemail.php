<?php

require 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Function to generate a random voucher code
function generateVoucherCode() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Define characters to choose from
    $voucherCode = ''; // Start with an empty string

    // Generate a random voucher code of length 8 (you can adjust the length as needed)
    for ($i = 0; $i < 8; $i++) {
        $voucherCode .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $voucherCode;
}

// Usage
$voucherCode = generateVoucherCode();



if (isset($_POST['email'])) {
    $id = $_POST['payid']; 
    $email = $_POST['email'];
    $name = $_POST['fname'] . ' ' . $_POST['lname'];
    $payment = $_POST['payment'];
    $sub = "Payment Confirmation - The Firm LB";
    
    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("Invalid email address: $email");
        exit("Invalid email address");
    }

    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // Enable debugging output for detailed logs
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
        $mail->Subject = $sub; 
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4;">
            <div style="max-width: 600px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                <h2 style="color: #333; text-align: center;">The Firm</h2>
                <h3 style="color: #007bff; text-align: center;">Dear '.$name.',</h3><br>
                <p style="font-size: 16px; color: #555; line-height: 1.5;">
                    We sincerely thank you for your recent payment. Your transaction has been successfully processed, and we are grateful for your trust in our legal services.
                    We would like to confirm that your voucher or payment has been successfully applied. 
                    You are now eligible to access the legal services included with your voucher.
                    Should you have any questions regarding your payment or our services, please feel free to reach out to us.<br>
                    Payment Details:
                    <br>1-Voucher/Service Amount: ['.$payment.' $]
                    <br>2. Voucher Code: ' . $voucherCode . ' (Please keep this code for your records) <br>
                    We are dedicated to providing you with exceptional legal support and service. If you need assistance with any legal matters, do not hesitate to contact us. Our team is here to help you every step of the way.
                    <br>Thank you again for choosing <b> The Firm</b>. We look forward to serving your legal needs in the future.
                    <br>Best regards,<br>
                </p>
                <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                <p style="text-align: center; font-size: 14px; color: #888;">
                    <strong>The Firm LB</strong><br>
                    <a href="https://yourwebsite.com" style="color: #007bff; text-decoration: none;">Visit our website</a>
                </p>
            </div>
        </div>';
        $mail->AltBody = "The Firm - Your Case Is Accepted\n\nSoon we will open up a Zoom meeting to discuss your case. Thank you.\n\nThe Firm LB";

        if ($mail->send()) {
            // If email sent successfully, log success
            error_log("Email sent successfully to $email");
            header("Location: cashierpayment.php?id=" . $id);
        } else {
            error_log("Failed to send email to $email");
        }
        
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        echo "Message could not be sent. Please check the logs for more information.";
    }
} else {
    error_log("Email not set in POST data");
    echo "Error: Email not provided";
}
?>
