<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $title         = $_POST['title'] ?? '';
    $name          = $_POST['full_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $contact       = $_POST['contact'] ?? '';
    $dateRange     = $_POST['date_range'] ?? '';
    $persons       = $_POST['persons'] ?? '';
    $country       = $_POST['country'] ?? '';
    $accommodation = $_POST['accommodation'] ?? '';
    $foundUs       = $_POST['found_us'] ?? '';
    $message       = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'mail.stelaranholidays.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bookings@stelaranholidays.com';
        $mail->Password   = 'AAp5roLnMO'; // 🔴 CHANGE
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Email setup
        $mail->setFrom('bookings@stelaranholidays.com', 'Book A Tour');
        $mail->addAddress('stelaranholidays@gmail.com');   
        $mail->addBCC('linda.nayana96@gmail.com');    // Blind carbon copy
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
                                <td>'.$title.' '.$name.'</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>'.$email.'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Contact</strong></td>
                                <td>'.$contact.'</td>
                            </tr>
                            <tr>
                                <td><strong>Country</strong></td>
                                <td>'.$country.'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Date Range</strong></td>
                                <td>'.$dateRange.'</td>
                            </tr>
                            <tr>
                                <td><strong>Persons</strong></td>
                                <td>'.$persons.'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Accommodation</strong></td>
                                <td>'.$accommodation.'</td>
                            </tr>
                            <tr>
                                <td><strong>Found Us</strong></td>
                                <td>'.$foundUs.'</td>
                            </tr>
                            <tr style="background:#f8f9fb;">
                                <td><strong>Message</strong></td>
                                <td>'.$message.'</td>
                            </tr>
                        </table>
        
                        <!-- Button -->
                        <a href="mailto:'.$email.'" style="
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
        // Redirect to home page
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        echo "❌ Error: {$mail->ErrorInfo}";
    }
}
