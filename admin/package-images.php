<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    
    $msg = "";
    $error = "";
    
    if(isset($_POST['submit'])) {
        $packageid = $_POST['packageid'];
        $imgmaintype = isset($_POST['imgmaintype']) ? 1 : 0;
    
        $image = $_FILES["packageimage"]["name"];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        
        // Rename image with a unique name
        $new_image_name = "img_" . uniqid() . "." . $ext;
        
        // Determine the correct directory based on imgmaintype
        if ($imgmaintype == 1) {
            $target_directory = "img/pkgImages/galary_main/";
        } else {
            $target_directory = "img/pkgImages/galary_sub/";
        }
        
        // Ensure the directory exists
        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0755, true);
        }
        
        // Move the uploaded file to the correct directory
        if (move_uploaded_file($_FILES["packageimage"]["tmp_name"], $target_directory.$new_image_name)) {
            // Insert the image data into the database
            $sql = "INSERT INTO tbltourpkgimages (PackageId,imgmaintype,PackageImage) VALUES (:packageid, :imgmaintype, :packageimage)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
            $query->bindParam(':imgmaintype', $imgmaintype, PDO::PARAM_INT);
            $query->bindParam(':packageimage', $new_image_name, PDO::PARAM_STR);
            $query->execute();
    
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId) {
                $msg = "Image Uploaded Successfully";
            } else {
                $error = "Something went wrong. Please try again";
            }
        } else {
            $error = "Failed to upload image. Please try again";
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Upload Package Image</title>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap{
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Upload Package Image</h3>
        <a href="update-package.php?pid=<?php echo $pid; ?>" class="btn btn-primary">Back<?php echo $pid; ?></a>
        
        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="packageid">Package ID</label>
                <input type="text" class="form-control" name="packageid" id="packageid" placeholder="Enter Package ID" required>
            </div>

            <div class="form-group">
                <label for="imgmaintype">Image Main Type</label>
                <input type="checkbox" name="imgmaintype" id="imgmaintype" value="1"> Main Image
            </div>

            <div class="form-group">
                <label for="packageimage">Select Image</label>
                <input type="file" name="packageimage" id="packageimage" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Upload Image</button>
        </form>
    </div>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
