<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require_once __DIR__ . '/includes/helpers.php';

$localMailConfig = __DIR__ . '/mail.local.php';
if (is_file($localMailConfig)) {
    require $localMailConfig;
}

$smtpHost = env_value('SMTP_HOST', 'mail.stelaranholidays.com');
$smtpUser = env_value('SMTP_USER', 'bookings@stelaranholidays.com');
$smtpPass = env_value('SMTP_PASS', 'AAp5roLnMO');
$smtpPort = (int) env_value('SMTP_PORT', 465);
$smtpFrom = env_value('SMTP_FROM', $smtpUser);
$smtpFromName = env_value('SMTP_FROM_NAME', 'Stelaran Holidays');
$mailTo = env_value('CONTACT_MAIL_TO', 'linda.nayana96@gmail.com');

if (!$smtpHost || !$smtpUser || !$smtpPass || !$smtpFrom || !$mailTo) {
    exit('SMTP configuration is missing.');
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUser;
    $mail->Password   = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $smtpPort;

    $mail->setFrom($smtpFrom, $smtpFromName);
    $mail->addAddress($mailTo);

    $mail->isHTML(true);
    $mail->Subject = 'SMTP Test Mail';
    $mail->Body    = '<h3>SMTP is working</h3><p>Email sent successfully.</p>';

    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    error_log($mail->ErrorInfo);
    echo 'Email could not be sent.';
}

?>
