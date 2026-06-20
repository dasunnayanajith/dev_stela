<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/content_helpers.php';

require_admin_login();
sh_ensure_content_tables($dbh);

$allowedTypes = ['title', 'accommodation', 'found_us'];
$msg = '';
$error = '';
$editPrompt = null;

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $query = $dbh->prepare("DELETE FROM tblbooktourprompts WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $msg = 'Prompt option deleted successfully.';
}

if (isset($_GET['toggle'])) {
    $id = (int) $_GET['toggle'];
    $query = $dbh->prepare("UPDATE tblbooktourprompts SET is_active = IF(is_active = 1, 0, 1) WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $msg = 'Prompt option status updated.';
}

if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $query = $dbh->prepare("SELECT * FROM tblbooktourprompts WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $editPrompt = $query->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['save_prompt'])) {
    $id = (int) ($_POST['id'] ?? 0);
    $promptType = clean_text($_POST['prompt_type'] ?? '', 50);
    $optionLabel = clean_text($_POST['option_label'] ?? '', 150);
    $displayOrder = (int) ($_POST['display_order'] ?? 0);
    $isActive = isset($_POST['is_active']) ? 1 : 0;

    if (!in_array($promptType, $allowedTypes, true)) {
        $error = 'Please select a valid prompt type.';
    } elseif (!$optionLabel) {
        $error = 'Option label is required.';
    }

    if (!$error) {
        if ($id > 0) {
            $sql = "UPDATE tblbooktourprompts
                    SET prompt_type = :prompt_type,
                        option_label = :option_label,
                        display_order = :display_order,
                        is_active = :is_active
                    WHERE id = :id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $msg = 'Prompt option updated successfully.';
        } else {
            $sql = "INSERT INTO tblbooktourprompts
                    (prompt_type, option_label, display_order, is_active)
                    VALUES (:prompt_type, :option_label, :display_order, :is_active)";
            $query = $dbh->prepare($sql);
            $msg = 'Prompt option created successfully.';
        }

        $query->bindParam(':prompt_type', $promptType, PDO::PARAM_STR);
        $query->bindParam(':option_label', $optionLabel, PDO::PARAM_STR);
        $query->bindParam(':display_order', $displayOrder, PDO::PARAM_INT);
        $query->bindParam(':is_active', $isActive, PDO::PARAM_INT);
        $query->execute();
        $editPrompt = null;
    }
}

$query = $dbh->prepare("SELECT * FROM tblbooktourprompts ORDER BY prompt_type ASC, display_order ASC, id ASC");
$query->execute();
$prompts = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Manage Book A Tour Prompts</title>
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
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<style>
.errorWrap{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #dd3d36;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.succWrap{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #5cb85c;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.action-links a{margin-right:6px;margin-bottom:6px;}
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
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Book A Tour Prompts</li>
</ol>

<div class="grid-form">
<div class="grid-form1">
    <h3><?php echo $editPrompt ? 'Edit Prompt Option' : 'Add Prompt Option'; ?></h3>
    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
    <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
    <form class="form-horizontal" method="post">
        <input type="hidden" name="id" value="<?php echo htmlentities($editPrompt['id'] ?? 0); ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Prompt Type</label>
            <div class="col-sm-8">
                <select name="prompt_type" class="form-control1">
                    <?php foreach ($allowedTypes as $type) { ?>
                    <option value="<?php echo htmlentities($type); ?>" <?php echo ($editPrompt['prompt_type'] ?? '') === $type ? 'selected' : ''; ?>><?php echo htmlentities(sh_prompt_type_label($type)); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Option Label</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="option_label" value="<?php echo htmlentities($editPrompt['option_label'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Display Order</label>
            <div class="col-sm-8">
                <input type="number" class="form-control1" name="display_order" value="<?php echo htmlentities($editPrompt['display_order'] ?? 0); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Active</label>
            <div class="col-sm-8">
                <label><input type="checkbox" name="is_active" <?php echo (int)($editPrompt['is_active'] ?? 1) === 1 ? 'checked' : ''; ?>> Show in form</label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="save_prompt" class="btn-primary btn">Save Prompt</button>
                <?php if ($editPrompt) { ?><a href="manage-book-tour-prompts.php" class="btn btn-default">Cancel</a><?php } ?>
            </div>
        </div>
    </form>
</div>
</div>

<div class="agile-grids">
<div class="agile-tables">
<div class="w3l-table-info">
    <h2>Book A Tour Form Options</h2>
    <table id="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Option</th>
                <th>Order</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prompts as $prompt) { ?>
            <tr>
                <td><?php echo htmlentities(sh_prompt_type_label($prompt['prompt_type'])); ?></td>
                <td><?php echo htmlentities($prompt['option_label']); ?></td>
                <td><?php echo htmlentities($prompt['display_order']); ?></td>
                <td><?php echo $prompt['is_active'] ? 'Active' : 'Hidden'; ?></td>
                <td class="action-links">
                    <a class="btn btn-primary btn-sm" href="manage-book-tour-prompts.php?edit=<?php echo (int)$prompt['id']; ?>">Edit</a>
                    <a class="btn btn-warning btn-sm" href="manage-book-tour-prompts.php?toggle=<?php echo (int)$prompt['id']; ?>"><?php echo $prompt['is_active'] ? 'Hide' : 'Show'; ?></a>
                    <a class="btn btn-danger btn-sm" href="manage-book-tour-prompts.php?delete=<?php echo (int)$prompt['id']; ?>" onclick="return confirm('Delete this option?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
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
