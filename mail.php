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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $submittedAt = isset($_POST['submitted_at']) ? (int) $_POST['submitted_at'] : 0;
    if (!empty($_POST['website']) || ($submittedAt && time() - $submittedAt < 3)) {
        http_response_code(400);
        exit('Invalid submission.');
    }

    if (!verify_turnstile_token($_POST['cf-turnstile-response'] ?? '', $_SERVER['REMOTE_ADDR'] ?? null)) {
        http_response_code(400);
        exit('Verification failed. Please try again.');
    }

    $title         = clean_text($_POST['title'] ?? '', 20);
    $name          = clean_text($_POST['full_name'] ?? '', 120);
    $email         = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $contact       = clean_text($_POST['contact'] ?? '', 40);
    $dateRange     = clean_text($_POST['date_range'] ?? '', 120);
    $persons       = clean_text($_POST['persons'] ?? '', 120);
    $country       = clean_text($_POST['country'] ?? '', 80);
    $accommodation = clean_text($_POST['accommodation'] ?? '', 80);
    $foundUs       = clean_text($_POST['found_us'] ?? '', 80);
    $message       = clean_text($_POST['message'] ?? '', 2000);

    if (!$name || !$email || !$contact || !$dateRange || !$persons) {
        http_response_code(422);
        exit('Please complete the required fields.');
    }

    $smtpHost = env_value('SMTP_HOST', 'mail.stelaranholidays.com');
    $smtpUser = env_value('SMTP_USER', 'bookings@stelaranholidays.com');
    $smtpPass = env_value('SMTP_PASS', 'AAp5roLnMO');
    $smtpPort = (int) env_value('SMTP_PORT', 465);
    $smtpFrom = env_value('SMTP_FROM', $smtpUser);
    $smtpFromName = env_value('SMTP_FROM_NAME', 'Book A Tour');
    $mailTo = env_value('CONTACT_MAIL_TO', 'stelaranholidays@gmail.com');
    $mailBcc = env_value('CONTACT_MAIL_BCC', 'linda.nayana96@gmail.com');

    if (!$smtpHost || !$smtpUser || !$smtpPass || !$smtpFrom || !$mailTo) {
        error_log('SMTP configuration is missing.');
        http_response_code(500);
        exit('Email service is not configured.');
    }

    $safe = [
        'title' => escape_html($title),
        'name' => escape_html($name),
        'email' => escape_html($email),
        'contact' => escape_html($contact),
        'dateRange' => escape_html($dateRange),
        'persons' => escape_html($persons),
        'country' => escape_html($country),
        'accommodation' => escape_html($accommodation),
        'foundUs' => escape_html($foundUs),
        'message' => nl2br(escape_html($message)),
    ];

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
        if ($mailBcc) {
            $mail->addBCC($mailBcc);
        }
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'New Tour Booking Request';

        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="UTF-8">
        <title>New Tour Booking</title>
        </head>
        <body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">
        
        <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
        <td align="center">
        
            <!-- Main container -->
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; margin:30px auto; border-radius:8px; overflow:hidden;">
        
                <!-- Header -->
                <tr>
                    <td style="background:#eaf6ff; padding:20px; text-align:center;">
                        <img src="https://stelaranholidays.com/assets/img/logo.png" alt="Stelaran Holidays" width="160">
                    </td>
                </tr>
        
                <!-- Body -->
                <tr>
                    <td style="padding:30px; text-align:center;">
                        <h2 style="color:#0a2540;">New Tour Booking Request</h2>
                        <p style="color:#555; font-size:14px;">
                            A new customer has submitted a booking request through your website.
                        </p>
        
                        <!-- Booking details -->
                        <table width="100%" cellpadding="10" cellspacing="0" style="margin-top:20px; border-collapse:collapse;">
                            <tr style="background:#f8f9fb;">
                                <td><strong>Name</strong></td>
                                <td>'.$safe['title'].' '.$safe['name'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>'.$safe['email'].'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Contact</strong></td>
                                <td>'.$safe['contact'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Country</strong></td>
                                <td>'.$safe['country'].'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Date Range</strong></td>
                                <td>'.$safe['dateRange'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Persons</strong></td>
                                <td>'.$safe['persons'].'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Accommodation</strong></td>
                                <td>'.$safe['accommodation'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Found Us</strong></td>
                                <td>'.$safe['foundUs'].'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Message</strong></td>
                                <td>'.$safe['message'].'</td>
                            </tr>
                        </table>
        
                        <!-- Button -->
                        <a href="mailto:'.$safe['email'].'" style="
                            display:inline-block;
                            margin-top:25px;
                            padding:12px 30px;
                            background:#007bff;
                            color:#ffffff;
                            text-decoration:none;
                            border-radius:5px;
                            font-size:14px;
                        ">
                            Reply to Customer
                        </a>
        
                    </td>
                </tr>
        
                <!-- Footer -->
                <tr>
                    <td style="background:#0a2540; color:#ffffff; padding:20px; text-align:center; font-size:12px;">
                        © '.date("Y").' Stelaran Holidays<br>
                        <a href="https://stelaranholidays.com" style="color:#9dcfff; text-decoration:none;">Visit Website</a>
                    </td>
                </tr>
        
            </table>
        
        </td>
        </tr>
        </table>
        
        </body>
        </html>
        ';


        $mail->send();
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        error_log($mail->ErrorInfo);
        http_response_code(500);
        echo "Email could not be sent.";
    }
}
