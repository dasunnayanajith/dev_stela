<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'mail.stelaranholidays.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bookings@stelaranholidays.com';
    $mail->Password   = 'AAp5roLnMO'; // 🔴 real password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Email
    $mail->setFrom('bookings@stelaranholidays.com', 'Stelaran Holidays');
    $mail->addAddress('linda.nayana96@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'SMTP Test Mail';
    $mail->Body    = '<h3>SMTP is working</h3><p>Email sent successfully.</p>';

    $mail->send();
    echo '✅ Email sent successfully';
} catch (Exception $e) {
    echo '❌ Error: ' . $mail->ErrorInfo;
}

?>