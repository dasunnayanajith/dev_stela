<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once __DIR__ . '/../includes/helpers.php';

require_admin_login();

$uploadMessage = '';
$deleteMessage = '';
$editMessage = '';
$uploadDir = __DIR__ . '/../assets/img/gallery/';
$urlPath = '../assets/img/gallery/';
$filenamePrefix = 'gallery_7_';
$newHeight = 312;

$dbh->exec("CREATE TABLE IF NOT EXISTS tblgallery (
    id INT NOT NULL AUTO_INCREMENT,
    imgname VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    uploaded_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $idToDelete = (int) $_GET['delete'];

    $stmt = $dbh->prepare("SELECT imgname FROM tblgallery WHERE id = ?");
    $stmt->execute([$idToDelete]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $imgPath = $uploadDir . $row['imgname'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }

        $stmt = $dbh->prepare("DELETE FROM tblgallery WHERE id = ?");
        $stmt->execute([$idToDelete]);
        $deleteMessage = "Image deleted.";
    } else {
        $deleteMessage = "Image not found.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $locationInput = clean_text($_POST['location'] ?? '', 150);

    if (!$locationInput) {
        $uploadMessage = "Location is required.";
    } elseif (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (!$uploadMessage && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadError = validate_uploaded_image($_FILES['image']);

        if ($uploadError) {
            $uploadMessage = $uploadError;
        } else {
            $tmpFile = $_FILES['image']['tmp_name'];
            $imageInfo = getimagesize($tmpFile);
            list($originalWidth, $originalHeight) = $imageInfo;
            $newWidth = (int) ($originalWidth * ($newHeight / $originalHeight));

            switch ($imageInfo['mime']) {
                case 'image/jpeg':
                    $srcImage = imagecreatefromjpeg($tmpFile);
                    break;
                case 'image/png':
                    $srcImage = imagecreatefrompng($tmpFile);
                    break;
                case 'image/gif':
                    $srcImage = imagecreatefromgif($tmpFile);
                    break;
                default:
                    $srcImage = false;
                    $uploadMessage = "Unsupported image type.";
            }

            if ($srcImage) {
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resizedImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

                $i = 1;
                do {
                    $filename = $filenamePrefix . $i . '.jpg';
                    $fullPath = $uploadDir . $filename;
                    $i++;
                } while (file_exists($fullPath));

                imagejpeg($resizedImage, $fullPath, 90);
                imagedestroy($srcImage);
                imagedestroy($resizedImage);

                $stmt = $dbh->prepare("INSERT INTO tblgallery (imgname, location) VALUES (?, ?)");
                $stmt->execute([$filename, $locationInput]);
                $uploadMessage = "Uploaded: " . $filename;
            }
        }
    } elseif (!$uploadMessage) {
        $uploadMessage = "Error uploading image.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_location'])) {
    $id = (int) $_POST['id'];
    $newLocation = clean_text($_POST['new_location'] ?? '', 150);

    if ($newLocation) {
        $stmt = $dbh->prepare("UPDATE tblgallery SET location = ? WHERE id = ?");
        $stmt->execute([$newLocation, $id]);
        $editMessage = "Location updated.";
    } else {
        $editMessage = "Location cannot be empty.";
    }
}

$stmt = $dbh->query("SELECT * FROM tblgallery ORDER BY uploaded_at DESC");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Manage Gallery</title>
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
.message{padding:10px;margin:0 0 20px 0;background:#fff;border-left:4px solid #2c7be5;box-shadow:0 1px 1px 0 rgba(0,0,0,.1);}
.thumb{width:90px;height:65px;object-fit:cover;border-radius:4px;}
.edit-form{display:flex;gap:8px;align-items:center;}
.edit-form input{min-width:150px;}
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
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Gallery</li>
</ol>

<div class="grid-form">
<div class="grid-form1">
    <h3>Upload Gallery Image</h3>
    <?php foreach ([$uploadMessage, $deleteMessage, $editMessage] as $message) { ?>
        <?php if ($message) { ?><div class="message"><?php echo htmlentities($message); ?></div><?php } ?>
    <?php } ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <input type="file" name="image" accept="image/*" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Location</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name="location" placeholder="Location eg. Colombo" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="upload" class="btn-primary btn">Upload Image</button>
            </div>
        </div>
    </form>
</div>
</div>

<div class="agile-grids">
<div class="agile-tables">
<div class="w3l-table-info">
    <h2>Gallery Images</h2>
    <table id="table">
        <thead>
            <tr>
                <th>Preview</th>
                <th>Filename</th>
                <th>Location</th>
                <th>Uploaded</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $img) { ?>
            <tr>
                <td><img class="thumb" src="<?php echo $urlPath . htmlentities($img['imgname']); ?>" alt=""></td>
                <td><?php echo htmlentities($img['imgname']); ?></td>
                <td>
                    <form method="post" class="edit-form">
                        <input type="hidden" name="id" value="<?php echo (int)$img['id']; ?>">
                        <input type="text" class="form-control" name="new_location" value="<?php echo htmlentities($img['location']); ?>" required>
                        <button type="submit" name="update_location" class="btn btn-success btn-sm">Update</button>
                    </form>
                </td>
                <td><?php echo htmlentities($img['uploaded_at']); ?></td>
                <td class="action-links">
                    <a class="btn btn-danger btn-sm" href="manage-gallery.php?delete=<?php echo (int)$img['id']; ?>" onclick="return confirm('Delete this image?');">Delete</a>
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
