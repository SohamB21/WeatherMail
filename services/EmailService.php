<?php

class EmailService
{
    public function sendEmail($to, $subject, $body)
    {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= 'From: weathermail.ai@gmail.com' . "\r\n";

        $logMessage = "Sending email to: $to\nSubject: $subject\nBody:\n$body\nHeaders:\n$headers\n";

        file_put_contents('email_log.txt', $logMessage, FILE_APPEND);

        // To send HTML mail, the Content-type header must be set
        $headers .= "Content-type: text/html\r\n";

        // Additional headers
        $headers .= "From: weathermail.ai@gmail.com\r\n";

        // Mail it
        if (mail($to, $subject, $body, $headers)) {
            echo '<div class="alert alert-success" role="alert">Email sent successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error sending email.</div>';
        }
    }
}
?>
