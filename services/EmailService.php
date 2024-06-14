<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    public function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; // Disable verbose debug output (set to 2 for debugging)
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = EMAIL_USERNAME; // SMTP username from config.php
            $mail->Password   = EMAIL_PASSWORD; // SMTP password from config.php
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('weathermail.ai@gmail.com', 'WeatherMail');
            $mail->addAddress($to); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            echo '<div class="alert alert-success" role="alert">Email sent successfully!</div>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">Error sending email: ' . $mail->ErrorInfo . '</div>';
        }
    }
}
?>
