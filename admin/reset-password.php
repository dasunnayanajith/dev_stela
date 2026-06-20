<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/includes/password_reset_helpers.php';

admin_ensure_password_reset_table($dbh);

$token = clean_text($_GET['token'] ?? $_POST['token'] ?? '', 140);
$reset = admin_get_valid_reset($dbh, $token);
$msg = '';
$error = '';

if (!$reset) {
    $error = 'This password reset link is invalid or expired.';
}

if ($reset && isset($_POST['reset_password'])) {
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    if (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        $hashedPassword = md5($password);
        $query = $dbh->prepare("UPDATE tblusers SET Password = :password WHERE EmailId = :username");
        $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $query->bindParam(':username', $reset['user_email'], PDO::PARAM_STR);
        $query->execute();
        admin_mark_reset_used($dbh, (int) $reset['id']);
        $msg = 'Password updated successfully. You can now sign in.';
        $reset = false;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Set New Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<style>
.errorWrap{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #dd3d36;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.succWrap{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #5cb85c;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.reset-note{color:#fff;text-align:center;margin-top:14px;}
.reset-note a{color:#fff;text-decoration:underline;}
</style>
</head>
<body>
<div class="main-wthree">
<div class="container">
<div class="sin-w3-agile">
    <h2>Set New Password</h2>
    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
    <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
    <?php if($reset){ ?>
    <form method="post">
        <input type="hidden" name="token" value="<?php echo htmlentities($token); ?>">
        <div class="password-agileits">
            <span class="username">New Password:</span>
            <input type="password" name="password" class="password" required="">
            <div class="clearfix"></div>
        </div>
        <div class="password-agileits">
            <span class="username">Confirm Password:</span>
            <input type="password" name="confirm_password" class="password" required="">
            <div class="clearfix"></div>
        </div>
        <div class="login-w3">
            <input type="submit" class="login" name="reset_password" value="Update Password">
        </div>
        <div class="clearfix"></div>
    </form>
    <?php } ?>
    <p class="reset-note"><a href="index.php">Back to sign in</a></p>
</div>
</div>
</div>
</body>
</html>
