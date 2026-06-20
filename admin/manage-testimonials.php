<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/content_helpers.php';

require_admin_login();
sh_ensure_content_tables($dbh);

$msg = '';
$error = '';
$editTestimonial = null;
$uploadDir = __DIR__ . '/../assets/img/testimonial/';

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $query = $dbh->prepare("DELETE FROM tbltestimonials WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $msg = 'Testimonial deleted successfully.';
}

if (isset($_GET['toggle'])) {
    $id = (int) $_GET['toggle'];
    $query = $dbh->prepare("UPDATE tbltestimonials SET is_active = IF(is_active = 1, 0, 1) WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $msg = 'Testimonial status updated.';
}

if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $query = $dbh->prepare("SELECT * FROM tbltestimonials WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $editTestimonial = $query->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['save_testimonial'])) {
    $id = (int) ($_POST['id'] ?? 0);
    $clientName = clean_text($_POST['client_name'] ?? '', 150);
    $clientLocation = clean_text($_POST['client_location'] ?? '', 150);
    $rating = max(1, min(5, (int) ($_POST['rating'] ?? 5)));
    $testimonialText = clean_text($_POST['testimonial_text'] ?? '', 3000);
    $displayOrder = (int) ($_POST['display_order'] ?? 0);
    $isActive = isset($_POST['is_active']) ? 1 : 0;
    $imageFilename = clean_text($_POST['existing_image'] ?? '', 150);

    if (!empty($_FILES['testimonial_image']['name'])) {
        $uploadError = validate_uploaded_image($_FILES['testimonial_image']);
        if ($uploadError) {
            $error = $uploadError;
        } else {
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $imageFilename = safe_uploaded_image_name($_FILES['testimonial_image']['name'], 'testim_');
            if (!move_uploaded_file($_FILES['testimonial_image']['tmp_name'], $uploadDir . $imageFilename)) {
                $error = 'Failed to upload testimonial image.';
            }
        }
    }

    if (!$error && (!$clientName || !$testimonialText)) {
        $error = 'Client name and testimonial text are required.';
    }

    if (!$error) {
        if ($id > 0) {
            $sql = "UPDATE tbltestimonials
                    SET client_name = :client_name,
                        client_location = :client_location,
                        rating = :rating,
                        image_filename = :image_filename,
                        testimonial_text = :testimonial_text,
                        display_order = :display_order,
                        is_active = :is_active
                    WHERE id = :id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $msg = 'Testimonial updated successfully.';
        } else {
            $sql = "INSERT INTO tbltestimonials
                    (client_name, client_location, rating, image_filename, testimonial_text, display_order, is_active)
                    VALUES (:client_name, :client_location, :rating, :image_filename, :testimonial_text, :display_order, :is_active)";
            $query = $dbh->prepare($sql);
            $msg = 'Testimonial created successfully.';
        }

        $query->bindParam(':client_name', $clientName, PDO::PARAM_STR);
        $query->bindParam(':client_location', $clientLocation, PDO::PARAM_STR);
        $query->bindParam(':rating', $rating, PDO::PARAM_INT);
        $query->bindParam(':image_filename', $imageFilename, PDO::PARAM_STR);
        $query->bindParam(':testimonial_text', $testimonialText, PDO::PARAM_STR);
        $query->bindParam(':display_order', $displayOrder, PDO::PARAM_INT);
        $query->bindParam(':is_active', $isActive, PDO::PARAM_INT);
        $query->execute();
        $editTestimonial = null;
    }
}

$query = $dbh->prepare("SELECT * FROM tbltestimonials ORDER BY display_order ASC, id ASC");
$query->execute();
$testimonials = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Manage Testimonials</title>
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
.thumb{width:70px;height:70px;object-fit:cover;border-radius:4px;}
.form-control1.textarea-control{height:auto;min-height:110px;}
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
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Testimonials</li>
</ol>

<div class="grid-form">
<div class="grid-form1">
    <h3><?php echo $editTestimonial ? 'Edit Testimonial' : 'Add Testimonial'; ?></h3>
    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
    <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlentities($editTestimonial['id'] ?? 0); ?>">
        <input type="hidden" name="existing_image" value="<?php echo htmlentities($editTestimonial['image_filename'] ?? ''); ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Client Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="client_name" value="<?php echo htmlentities($editTestimonial['client_name'] ?? ''); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Location</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="client_location" value="<?php echo htmlentities($editTestimonial['client_location'] ?? ''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Rating</label>
            <div class="col-sm-8">
                <select name="rating" class="form-control1">
                    <?php for ($i = 5; $i >= 1; $i--) { ?>
                    <option value="<?php echo $i; ?>" <?php echo (int)($editTestimonial['rating'] ?? 5) === $i ? 'selected' : ''; ?>><?php echo $i; ?> Stars</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Display Order</label>
            <div class="col-sm-8">
                <input type="number" class="form-control1" name="display_order" value="<?php echo htmlentities($editTestimonial['display_order'] ?? 0); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <?php if (!empty($editTestimonial['image_filename'])) { ?>
                <p><img class="thumb" src="../assets/img/testimonial/<?php echo htmlentities($editTestimonial['image_filename']); ?>" alt=""></p>
                <?php } ?>
                <input type="file" name="testimonial_image" accept="image/*">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Testimonial</label>
            <div class="col-sm-8">
                <textarea class="form-control1 textarea-control" name="testimonial_text" required><?php echo htmlentities($editTestimonial['testimonial_text'] ?? ''); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Active</label>
            <div class="col-sm-8">
                <label><input type="checkbox" name="is_active" <?php echo (int)($editTestimonial['is_active'] ?? 1) === 1 ? 'checked' : ''; ?>> Show on website</label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="save_testimonial" class="btn-primary btn">Save Testimonial</button>
                <?php if ($editTestimonial) { ?><a href="manage-testimonials.php" class="btn btn-default">Cancel</a><?php } ?>
            </div>
        </div>
    </form>
</div>
</div>

<div class="agile-grids">
<div class="agile-tables">
<div class="w3l-table-info">
    <h2>Testimonials</h2>
    <table id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Location</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testimonials as $testimonial) { ?>
            <tr>
                <td><?php echo htmlentities($testimonial['display_order']); ?></td>
                <td>
                    <?php if (!empty($testimonial['image_filename'])) { ?>
                    <img class="thumb" src="../assets/img/testimonial/<?php echo htmlentities($testimonial['image_filename']); ?>" alt="">
                    <?php } ?>
                </td>
                <td><?php echo htmlentities($testimonial['client_name']); ?></td>
                <td><?php echo htmlentities($testimonial['client_location']); ?></td>
                <td><?php echo htmlentities($testimonial['rating']); ?></td>
                <td><?php echo $testimonial['is_active'] ? 'Active' : 'Hidden'; ?></td>
                <td class="action-links">
                    <a class="btn btn-primary btn-sm" href="manage-testimonials.php?edit=<?php echo (int)$testimonial['id']; ?>">Edit</a>
                    <a class="btn btn-warning btn-sm" href="manage-testimonials.php?toggle=<?php echo (int)$testimonial['id']; ?>"><?php echo $testimonial['is_active'] ? 'Hide' : 'Show'; ?></a>
                    <a class="btn btn-danger btn-sm" href="manage-testimonials.php?delete=<?php echo (int)$testimonial['id']; ?>" onclick="return confirm('Delete this testimonial?');">Delete</a>
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
