<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/../includes/helpers.php';

require_admin_login();

$msg = '';
$error = '';
$editUser = null;

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $query = $dbh->prepare("SELECT EmailId FROM tblusers WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $error = 'User not found.';
    } elseif ($user['EmailId'] === ($_SESSION['alogin'] ?? '')) {
        $error = 'You cannot delete the currently signed-in admin user.';
    } else {
        $query = $dbh->prepare("DELETE FROM tblusers WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $msg = 'User deleted successfully.';
    }
}

if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $query = $dbh->prepare("SELECT * FROM tblusers WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $editUser = $query->fetch(PDO::FETCH_ASSOC);

    if (!$editUser) {
        $error = 'User not found.';
    }
}

if (isset($_POST['save_user'])) {
    $id = (int) ($_POST['id'] ?? 0);
    $fullName = clean_text($_POST['full_name'] ?? '', 100);
    $mobileNumber = clean_text($_POST['mobile_number'] ?? '', 10);
    $email = clean_text($_POST['email'] ?? '', 70);
    $password = (string) ($_POST['password'] ?? '');
    $existingEmail = '';

    if (!$fullName) {
        $error = 'Full name is required.';
    } elseif (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'A valid email address is required.';
    } elseif ($mobileNumber && !preg_match('/^[0-9]{10}$/', $mobileNumber)) {
        $error = 'Mobile number must be 10 digits.';
    } elseif ($id === 0 && $password === '') {
        $error = 'Password is required for new users.';
    }

    if (!$error) {
        $query = $dbh->prepare("SELECT id FROM tblusers WHERE EmailId = :email AND id <> :id LIMIT 1");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if ($query->fetch(PDO::FETCH_ASSOC)) {
            $error = 'This email address is already registered.';
        }
    }

    if (!$error) {
        if ($id > 0) {
            $query = $dbh->prepare("SELECT EmailId FROM tblusers WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $existingUser = $query->fetch(PDO::FETCH_ASSOC);
            $existingEmail = $existingUser['EmailId'] ?? '';

            if ($password !== '') {
                $hashedPassword = md5($password);
                $sql = "UPDATE tblusers
                        SET FullName = :full_name,
                            MobileNumber = :mobile_number,
                            EmailId = :email,
                            Password = :password
                        WHERE id = :id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            } else {
                $sql = "UPDATE tblusers
                        SET FullName = :full_name,
                            MobileNumber = :mobile_number,
                            EmailId = :email
                        WHERE id = :id";
                $query = $dbh->prepare($sql);
            }

            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $msg = 'User updated successfully.';
        } else {
            $hashedPassword = md5($password);
            $sql = "INSERT INTO tblusers (FullName, MobileNumber, EmailId, Password)
                    VALUES (:full_name, :mobile_number, :email, :password)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $msg = 'User created successfully.';
        }

        $query->bindParam(':full_name', $fullName, PDO::PARAM_STR);
        $query->bindParam(':mobile_number', $mobileNumber, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        if ($existingEmail && $existingEmail === ($_SESSION['alogin'] ?? '')) {
            $_SESSION['alogin'] = $email;
        }
        $editUser = null;
    }
}

$query = $dbh->prepare("SELECT * FROM tblusers ORDER BY id ASC");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Manage Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<style>
.errorWrap{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #dd3d36;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.succWrap{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #5cb85c;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.action-links a{margin-right:6px;margin-bottom:6px;}
.help-note{color:#777;margin-top:6px;}
</style>
</head>
<body>
<div class="page-container">
<div class="left-content">
<div class="mother-grid-inner">
<?php include('includes/header.php');?>
<div class="clearfix"> </div>
</div>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Users</li>
</ol>

<div class="grid-form">
<div class="grid-form1">
    <h3><?php echo $editUser ? 'Edit User' : 'Add User'; ?></h3>
    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
    <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
    <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo htmlentities($editUser['id'] ?? 0); ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="full_name" value="<?php echo htmlentities($editUser['FullName'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Mobile Number</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="mobile_number" maxlength="10" value="<?php echo htmlentities($editUser['MobileNumber'] ?? ''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control1" name="email" value="<?php echo htmlentities($editUser['EmailId'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control1" name="password" <?php echo $editUser ? '' : 'required'; ?>>
                <?php if ($editUser) { ?><p class="help-note">Leave blank to keep the existing password.</p><?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="save_user" class="btn-primary btn">Save User</button>
                <?php if ($editUser) { ?><a href="manage-users.php" class="btn btn-default">Cancel</a><?php } ?>
            </div>
        </div>
    </form>
</div>
</div>

<div class="agile-grids">
<div class="agile-tables">
<div class="w3l-table-info">
    <h2>Users</h2>
    <table id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile No.</th>
                <th>Email Id</th>
                <th>RegDate</th>
                <th>Updation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cnt = 1;
            foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo htmlentities($cnt); ?></td>
                <td><?php echo htmlentities($user['FullName']); ?></td>
                <td><?php echo htmlentities($user['MobileNumber']); ?></td>
                <td><?php echo htmlentities($user['EmailId']); ?></td>
                <td><?php echo htmlentities($user['RegDate']); ?></td>
                <td><?php echo htmlentities($user['UpdationDate']); ?></td>
                <td class="action-links">
                    <a class="btn btn-primary btn-sm" href="manage-users.php?edit=<?php echo (int) $user['id']; ?>">Edit</a>
                    <?php if ($user['EmailId'] !== ($_SESSION['alogin'] ?? '')) { ?>
                    <a class="btn btn-danger btn-sm" href="manage-users.php?delete=<?php echo (int) $user['id']; ?>" onclick="return confirm('Delete this user?');">Delete</a>
                    <?php } ?>
                </td>
            </tr>
            <?php
                $cnt++;
            }
            ?>
        </tbody>
    </table>
</div>
</div>
</div>

<div class="inner-block"></div>
<?php include('includes/footer.php');?>
</div>
<?php include('includes/sidebarmenu.php');?>
<div class="clearfix"></div>
</div>
<script>
$(document).ready(function(){ $('#table').basictable(); });
var toggle = true;
$(".sidebar-icon").click(function() {
    if (toggle) {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position":"absolute"});
    } else {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function(){ $("#menu span").css({"position":"relative"}); }, 400);
    }
    toggle = !toggle;
});
</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
