<?php
// Prefer environment variables in production. Copy to mail.local.php only for local/private deployments.
putenv('SMTP_HOST=mail.example.com');
putenv('SMTP_USER=bookings@example.com');
putenv('SMTP_PASS=your_smtp_password');
putenv('SMTP_PORT=465');
putenv('SMTP_FROM=bookings@example.com');
putenv('SMTP_FROM_NAME=Book A Tour');
putenv('CONTACT_MAIL_TO=owner@example.com');
putenv('CONTACT_MAIL_BCC=');
putenv('TURNSTILE_SITE_KEY=');
putenv('TURNSTILE_SECRET_KEY=');
?>
