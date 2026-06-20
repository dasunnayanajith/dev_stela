<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/includes/password_reset_helpers.php';

admin_ensure_password_reset_table($dbh);

$msg = '';
$error = '';

if (isset($_POST['reset_request'])) {
    $username = clean_text($_POST['username'] ?? '', 100);

    if (!$username) {
        $error = 'Please enter your email address.';
    } else {
        $query = $dbh->prepare("SELECT EmailId FROM tblusers WHERE EmailId = :username LIMIT 1");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $token = admin_create_reset_token($dbh, $username);
            admin_send_reset_email($username, admin_build_reset_url($token));
        }

        $msg = 'If that email exists, a password reset link has been sent to the configured admin email.';
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Password Reset</title>
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
    <h2>Reset Password</h2>
    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
    <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
    <form method="post">
        <div class="username">
            <span class="username">Email:</span>
            <input type="email" name="username" class="name" required="">
            <div class="clearfix"></div>
        </div>
        <div class="login-w3">
            <input type="submit" class="login" name="reset_request" value="Send Reset Link">
        </div>
        <div class="clearfix"></div>
    </form>
    <p class="reset-note"><a href="index.php">Back to sign in</a></p>
</div>
</div>
</div>
</body>
</html>
