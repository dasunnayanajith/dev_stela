<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/package_helpers.php';

require_admin_login();
sh_ensure_package_visibility_column($dbh);

$msg = '';
$error = '';
$editTour = null;
$uploadDir = __DIR__ . '/pacakgeimages/';

function tour_column_exists($dbh, $column)
{
    static $columns = null;
    if ($columns === null) {
        $columns = [];
        $query = $dbh->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'tbltourpackages'");
        $query->execute();
        foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $name) {
            $columns[strtolower($name)] = true;
        }
    }
    return isset($columns[strtolower($column)]);
}

function tour_value($tour, $field, $default = '')
{
    return isset($tour[$field]) ? $tour[$field] : $default;
}

if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $packageId = (int) $_GET['toggle'];
    $query = $dbh->prepare("UPDATE tbltourpackages SET is_active = IF(is_active = 1, 0, 1) WHERE PackageId = :packageid");
    $query->bindParam(':packageid', $packageId, PDO::PARAM_INT);
    $query->execute();
    $msg = 'Tour visibility updated.';
}

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $packageId = (int) $_GET['delete'];
    $query = $dbh->prepare("DELETE FROM tbltourpackages WHERE PackageId = :packageid");
    $query->bindParam(':packageid', $packageId, PDO::PARAM_INT);
    $query->execute();
    $msg = 'Tour deleted successfully.';
}

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $packageId = (int) $_GET['edit'];
    $query = $dbh->prepare("SELECT * FROM tbltourpackages WHERE PackageId = :packageid");
    $query->bindParam(':packageid', $packageId, PDO::PARAM_INT);
    $query->execute();
    $editTour = $query->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['save_tour'])) {
    $packageId = (int) ($_POST['packageid'] ?? 0);
    $packageName = clean_text($_POST['packagename'] ?? '', 200);
    $packageType = clean_text($_POST['packagetype'] ?? '', 150);
    $packageLocation = clean_text($_POST['packagelocation'] ?? '', 100);
    $packagePrice = (int) ($_POST['packageprice'] ?? 0);
    $packageRate = clean_text($_POST['packagerate'] ?? '', 50);
    $packageDate = clean_text($_POST['packagedate'] ?? '', 50);
    $packageFeatures = clean_text($_POST['packagefeatures'] ?? '', 255);
    $packageDetails = clean_text($_POST['packagedetails'] ?? '', 5000);
    $tourRadarId = clean_text($_POST['tr_id'] ?? '', 80);
    $isActive = isset($_POST['is_active']) ? 1 : 0;
    $packageImage = clean_text($_POST['existing_image'] ?? '', 150);

    if (!$packageName) {
        $error = 'Tour name is required.';
    }

    if (!$error && !empty($_FILES['packageimage']['name'])) {
        $uploadError = validate_uploaded_image($_FILES['packageimage']);
        if ($uploadError) {
            $error = $uploadError;
        } else {
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $packageImage = safe_uploaded_image_name($_FILES['packageimage']['name'], 'tour_');
            if (!move_uploaded_file($_FILES['packageimage']['tmp_name'], $uploadDir . $packageImage)) {
                $error = 'Failed to upload tour image.';
            }
        }
    }

    if (!$error) {
        $data = [
            'PackageName' => $packageName,
            'PackageType' => $packageType,
            'PackageLocation' => $packageLocation,
            'PackagePrice' => $packagePrice,
            'PackageFetures' => $packageFeatures,
            'PackageDetails' => $packageDetails,
            'PackageImage' => $packageImage,
            'is_active' => $isActive,
        ];

        if (tour_column_exists($dbh, 'PackageRate')) {
            $data['PackageRate'] = $packageRate;
        }
        if (tour_column_exists($dbh, 'PackageDate')) {
            $data['PackageDate'] = $packageDate;
        }
        if (tour_column_exists($dbh, 'TR_id')) {
            $data['TR_id'] = $tourRadarId;
        }

        if ($packageId > 0) {
            $sets = [];
            foreach ($data as $column => $value) {
                $sets[] = "$column = :$column";
            }
            $sql = "UPDATE tbltourpackages SET " . implode(', ', $sets) . " WHERE PackageId = :PackageId";
            $query = $dbh->prepare($sql);
            foreach ($data as $column => $value) {
                $query->bindValue(':' . $column, $value);
            }
            $query->bindValue(':PackageId', $packageId, PDO::PARAM_INT);
            $query->execute();
            $msg = 'Tour updated successfully.';
        } else {
            $columns = array_keys($data);
            $placeholders = array_map(function ($column) {
                return ':' . $column;
            }, $columns);
            $sql = "INSERT INTO tbltourpackages (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
            $query = $dbh->prepare($sql);
            foreach ($data as $column => $value) {
                $query->bindValue(':' . $column, $value);
            }
            $query->execute();
            $msg = 'Tour created successfully.';
        }

        $editTour = null;
    }
}

$query = $dbh->prepare("SELECT * FROM tbltourpackages ORDER BY PackageId DESC");
$query->execute();
$tours = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Manage Tours</title>
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
.thumb{width:80px;height:60px;object-fit:cover;border-radius:4px;}
.form-control1.textarea-control{height:auto;min-height:120px;}
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
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Tours</li>
</ol>

<div class="grid-form">
<div class="grid-form1">
    <h3><?php echo $editTour ? 'Edit Tour' : 'Add Tour'; ?></h3>
    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
    <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="packageid" value="<?php echo htmlentities(tour_value($editTour, 'PackageId', 0)); ?>">
        <input type="hidden" name="existing_image" value="<?php echo htmlentities(tour_value($editTour, 'PackageImage')); ?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">Tour Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="packagename" value="<?php echo htmlentities(tour_value($editTour, 'PackageName')); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Type</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="packagetype" value="<?php echo htmlentities(tour_value($editTour, 'PackageType')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Location</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="packagelocation" value="<?php echo htmlentities(tour_value($editTour, 'PackageLocation')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Price USD</label>
            <div class="col-sm-8">
                <input type="number" class="form-control1" name="packageprice" value="<?php echo htmlentities(tour_value($editTour, 'PackagePrice', 0)); ?>">
            </div>
        </div>
        <?php if (tour_column_exists($dbh, 'PackageRate')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Rating</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="packagerate" value="<?php echo htmlentities(tour_value($editTour, 'PackageRate')); ?>">
            </div>
        </div>
        <?php } ?>
        <?php if (tour_column_exists($dbh, 'PackageDate')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Days</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="packagedate" value="<?php echo htmlentities(tour_value($editTour, 'PackageDate')); ?>">
            </div>
        </div>
        <?php } ?>
        <?php if (tour_column_exists($dbh, 'TR_id')) { ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">TourRadar ID</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="tr_id" value="<?php echo htmlentities(tour_value($editTour, 'TR_id')); ?>">
            </div>
        </div>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Features</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="packagefeatures" value="<?php echo htmlentities(tour_value($editTour, 'PackageFetures')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Details</label>
            <div class="col-sm-8">
                <textarea class="form-control1 textarea-control" name="packagedetails"><?php echo htmlentities(tour_value($editTour, 'PackageDetails')); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <?php if (tour_value($editTour, 'PackageImage')) { ?>
                <p><img class="thumb" src="pacakgeimages/<?php echo htmlentities(tour_value($editTour, 'PackageImage')); ?>" alt=""></p>
                <?php } ?>
                <input type="file" name="packageimage" accept="image/*">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Visible</label>
            <div class="col-sm-8">
                <label><input type="checkbox" name="is_active" <?php echo (int)tour_value($editTour, 'is_active', 1) === 1 ? 'checked' : ''; ?>> Show on website</label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="save_tour" class="btn-primary btn">Save Tour</button>
                <?php if ($editTour) { ?><a href="manage-tours.php" class="btn btn-default">Cancel</a><?php } ?>
            </div>
        </div>
    </form>
</div>
</div>

<div class="agile-grids">
<div class="agile-tables">
<div class="w3l-table-info">
    <h2>Tours</h2>
    <table id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tours as $tour) { ?>
            <tr>
                <td><?php echo htmlentities($tour['PackageId']); ?></td>
                <td>
                    <?php if (!empty($tour['PackageImage'])) { ?>
                    <img class="thumb" src="pacakgeimages/<?php echo htmlentities($tour['PackageImage']); ?>" alt="">
                    <?php } ?>
                </td>
                <td><?php echo htmlentities($tour['PackageName']); ?></td>
                <td><?php echo htmlentities($tour['PackageType']); ?></td>
                <td>$<?php echo htmlentities($tour['PackagePrice']); ?></td>
                <td><?php echo (int)$tour['is_active'] === 1 ? 'Shown' : 'Hidden'; ?></td>
                <td class="action-links">
                    <a class="btn btn-primary btn-sm" href="manage-tours.php?edit=<?php echo (int)$tour['PackageId']; ?>">Edit</a>
                    <a class="btn btn-warning btn-sm" href="manage-tours.php?toggle=<?php echo (int)$tour['PackageId']; ?>"><?php echo (int)$tour['is_active'] === 1 ? 'Hide' : 'Show'; ?></a>
                    <a class="btn btn-info btn-sm" href="manage_highlights.php?pkgid=<?php echo (int)$tour['PackageId']; ?>">Highlights</a>
                    <a class="btn btn-info btn-sm" href="manage_activities.php?pkgid=<?php echo (int)$tour['PackageId']; ?>">Activities</a>
                    <a class="btn btn-info btn-sm" href="package-images.php?pkgid=<?php echo (int)$tour['PackageId']; ?>">Images</a>
                    <a class="btn btn-danger btn-sm" href="manage-tours.php?delete=<?php echo (int)$tour['PackageId']; ?>" onclick="return confirm('Delete this tour?');">Delete</a>
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
