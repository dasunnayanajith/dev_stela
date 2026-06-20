<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../PHPMailer/Exception.php';
require_once __DIR__ . '/../../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/SMTP.php';

function admin_ensure_password_reset_table($dbh)
{
    $dbh->exec("CREATE TABLE IF NOT EXISTS tbluser_password_resets (
        id INT NOT NULL AUTO_INCREMENT,
        user_email VARCHAR(100) NOT NULL,
        token_hash CHAR(64) NOT NULL,
        expires_at DATETIME NOT NULL,
        used_at DATETIME DEFAULT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY token_hash (token_hash),
        KEY user_email (user_email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
}

function admin_build_reset_url($token)
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $adminPath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/admin/index.php')), '/');
    return $scheme . '://' . $host . $adminPath . '/reset-password.php?token=' . urlencode($token);
}

function admin_send_reset_email($userEmail, $resetUrl)
{
    $localMailConfig = __DIR__ . '/../../mail.local.php';
    if (is_file($localMailConfig)) {
        require $localMailConfig;
    }

    $smtpHost = env_value('SMTP_HOST', 'mail.stelaranholidays.com');
    $smtpUser = env_value('SMTP_USER', 'bookings@stelaranholidays.com');
    $smtpPass = env_value('SMTP_PASS', '');
    $smtpPort = (int) env_value('SMTP_PORT', 465);
    $smtpFrom = env_value('SMTP_FROM', $smtpUser);
    $smtpFromName = env_value('SMTP_FROM_NAME', 'Stelaran Holidays');
    $resetTo = env_value('ADMIN_RESET_EMAIL', 'linda.nayana96@gmail.com');

    if (!$smtpHost || !$smtpUser || !$smtpPass || !$smtpFrom || !$resetTo) {
        error_log('Admin password reset email configuration is missing.');
        return false;
    }

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUser;
        $mail->Password = $smtpPass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $smtpPort;

        $mail->setFrom($smtpFrom, $smtpFromName);
        $mail->addAddress($resetTo);
        $mail->isHTML(true);
        $mail->Subject = 'Admin Password Reset Request';
        $mail->Body = '
            <h3>Admin Password Reset</h3>
            <p>A password reset was requested for user <strong>' . escape_html($userEmail) . '</strong>.</p>
            <p>This link expires in 30 minutes:</p>
            <p><a href="' . escape_html($resetUrl) . '">' . escape_html($resetUrl) . '</a></p>
            <p>If you did not request this reset, ignore this email.</p>
        ';
        $mail->AltBody = "Admin password reset for {$userEmail}\n\n{$resetUrl}\n\nThis link expires in 30 minutes.";
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Admin password reset email failed: ' . $e->getMessage());
        return false;
    }
}

function admin_create_reset_token($dbh, $userEmail)
{
    try {
        $token = bin2hex(random_bytes(32));
    } catch (Exception $e) {
        $token = bin2hex(openssl_random_pseudo_bytes(32));
    }

    $tokenHash = hash('sha256', $token);
    $expiresAt = date('Y-m-d H:i:s', time() + 1800);

    $query = $dbh->prepare("INSERT INTO tbluser_password_resets (user_email, token_hash, expires_at) VALUES (:user_email, :token_hash, :expires_at)");
    $query->bindParam(':user_email', $userEmail, PDO::PARAM_STR);
    $query->bindParam(':token_hash', $tokenHash, PDO::PARAM_STR);
    $query->bindParam(':expires_at', $expiresAt, PDO::PARAM_STR);
    $query->execute();

    return $token;
}

function admin_get_valid_reset($dbh, $token)
{
    if (!$token) {
        return false;
    }

    $tokenHash = hash('sha256', $token);
    $query = $dbh->prepare("SELECT * FROM tbluser_password_resets WHERE token_hash = :token_hash AND used_at IS NULL AND expires_at > NOW() ORDER BY id DESC LIMIT 1");
    $query->bindParam(':token_hash', $tokenHash, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function admin_mark_reset_used($dbh, $id)
{
    $query = $dbh->prepare("UPDATE tbluser_password_resets SET used_at = NOW() WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
}
