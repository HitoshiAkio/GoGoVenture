<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/vendor/autoload.php';

session_start();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the form data
    if (empty($name) || empty($email) || empty($message)) {
        echo 'Please fill in all fields';
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // tls
        $mail->Username = 'mail_2@pbodavaodelsur.com';
        $mail->Password = 'It10@2026'; // App Password
        $mail->setFrom('mail_2@pbodavaodelsur.com', 'SMTP Demo'); // sender email
        $recipient = 'lormicdolin@gmail.com';
        $mail->addAddress($recipient); // recipient email
        $mail->isHTML(true);
        $mail->Subject = 'SMTP Demo';
        $mail->Body = '<p>Name: ' . $name . '</p><p>Email: ' . $email . '</p><p>Message: ' . $message . '</p>';
        $mail->AltBody = 'Sent with PHPMailer.';

        if ($mail->send()) {
            $_SESSION['Transcript.php'] = [
                'name' => $name,
                'email' => $email,
                'recipient' => $recipient,
                'subject' => 'SMTP Demo',
                'sent_at' => date(DATE_ATOM),
            ];
            header('Location: Transcript.php');
            exit;
        } else {
            echo 'Email Not Sent';
        }
    } catch (Exception $e) {
        echo 'Failed: ' . $mail->ErrorInfo;
    }
}