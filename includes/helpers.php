<?php
function env_value($key, $default = null) {
    $value = getenv($key);
    if ($value === false && isset($_ENV[$key])) {
        $value = $_ENV[$key];
    }
    return ($value === false || $value === '') ? $default : $value;
}

function require_admin_login($redirect = 'index.php') {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (empty($_SESSION['alogin'])) {
        header('Location: ' . $redirect);
        exit;
    }
}

function clean_text($value, $maxLength = 500) {
    $value = trim((string) $value);
    $value = preg_replace('/[[:cntrl:]]+/', ' ', $value);
    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $maxLength, 'UTF-8');
    }
    return substr($value, 0, $maxLength);
}

function escape_html($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function verify_turnstile_token($token, $remoteIp = null) {
    $secret = env_value('TURNSTILE_SECRET_KEY');
    if (!$secret) {
        return true;
    }

    if (!$token) {
        return false;
    }

    $payload = http_build_query([
        'secret' => $secret,
        'response' => $token,
        'remoteip' => $remoteIp,
    ]);

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $payload,
            'timeout' => 5,
        ],
    ]);

    $response = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false, $context);
    if ($response === false) {
        return false;
    }

    $result = json_decode($response, true);
    return !empty($result['success']);
}

function validate_uploaded_image($file, $maxBytes = 5242880) {
    if (empty($file) || !isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return 'Image upload failed.';
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        return 'Invalid upload source.';
    }

    if (!empty($file['size']) && $file['size'] > $maxBytes) {
        return 'Image must be 5 MB or smaller.';
    }

    $imageInfo = @getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        return 'Uploaded file is not a valid image.';
    }

    $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
    if (defined('IMAGETYPE_WEBP')) {
        $allowedTypes[] = IMAGETYPE_WEBP;
    }
    if (!in_array($imageInfo[2], $allowedTypes, true)) {
        return 'Only JPG, PNG, GIF, or WebP images are allowed.';
    }

    return '';
}

function safe_uploaded_image_name($originalName, $prefix = 'img_') {
    $extension = strtolower(pathinfo((string) $originalName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($extension, $allowedExtensions, true)) {
        $extension = 'jpg';
    }

    try {
        $suffix = bin2hex(random_bytes(8));
    } catch (Exception $e) {
        $suffix = uniqid('', true);
    }

    return $prefix . $suffix . '.' . $extension;
}
?>
