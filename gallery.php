<?php
include('includes/config.php');

$uploadMessage = '';
$deleteMessage = '';
$editMessage = '';
$uploadDir = __DIR__ . '/assets/img/gallery/';
$urlPath = '/assets/img/gallery/';
$filenamePrefix = 'gallery_7_';
$newHeight = 312;

// --- Handle Delete ---
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $idToDelete = intval($_GET['delete']);

    $stmt = $dbh->prepare("SELECT imgname FROM tblgallery WHERE id = ?");
    $stmt->execute([$idToDelete]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $imgPath = $uploadDir . $row['imgname'];
        if (file_exists($imgPath)) unlink($imgPath);

        $stmt = $dbh->prepare("DELETE FROM tblgallery WHERE id = ?");
        $stmt->execute([$idToDelete]);
        $deleteMessage = "✅ Image deleted.";
    } else {
        $deleteMessage = "❌ Image not found.";
    }
}

// --- Handle Upload ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $locationInput = trim($_POST['location'] ?? '');

    if (empty($locationInput)) {
        $uploadMessage = "❌ Location is required.";
    } elseif (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0 && !empty($locationInput)) {
        $tmpFile = $_FILES['image']['tmp_name'];
        $imageInfo = getimagesize($tmpFile);

        if ($imageInfo === false) {
            $uploadMessage = "❌ Not a valid image file.";
        } else {
            list($originalWidth, $originalHeight) = $imageInfo;
            $newWidth = intval($originalWidth * ($newHeight / $originalHeight));

            switch ($imageInfo['mime']) {
                case 'image/jpeg': $srcImage = imagecreatefromjpeg($tmpFile); break;
                case 'image/png': $srcImage = imagecreatefrompng($tmpFile); break;
                case 'image/gif': $srcImage = imagecreatefromgif($tmpFile); break;
                default: $srcImage = false; $uploadMessage = "❌ Unsupported image type.";
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

                $uploadMessage = "✅ Uploaded: <a href='$urlPath$filename' target='_blank'>$filename</a>";
            }
        }
    } else {
        $uploadMessage = "❌ Error uploading image.";
    }
}

// --- Handle Location Update ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_location'])) {
    $id = intval($_POST['id']);
    $newLocation = trim($_POST['new_location']);

    if (!empty($newLocation)) {
        $stmt = $dbh->prepare("UPDATE tblgallery SET location = ? WHERE id = ?");
        $stmt->execute([$newLocation, $id]);
        $editMessage = "✅ Location updated.";
    } else {
        $editMessage = "❌ Location cannot be empty.";
    }
}

// --- Fetch All Images ---
$stmt = $dbh->query("SELECT * FROM tblgallery ORDER BY uploaded_at DESC");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Gallery Upload & Manage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2em;
            background: #f4f4f4;
        }
        .container {
            max-width: 950px;
            margin: auto;
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 { margin-top: 0; }
        input[type="file"],
        input[type="text"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 1em;
            box-sizing: border-box;
            font-size: 1rem;
        }
        button {
            background: #2c7be5;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-weight: 600;
        }
        .message {
            padding: 10px;
            margin-bottom: 1em;
            background: #e0e0e0;
            border-left: 5px solid #2c7be5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2em;
            font-size: 0.9rem;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 0.75em;
            vertical-align: middle;
        }
        th {
            background: #f0f0f0;
            text-align: left;
        }
        img {
            height: 60px;
            border-radius: 4px;
            object-fit: cover;
        }
        .btn-delete {
            background: #e74c3c;
            color: white;
            padding: 6px 10px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 0.85rem;
        }
        .edit-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        /* Location input with pencil icon */
        .location-input-wrapper {
            position: relative;
            width: 180px;
        }
        .location-input-wrapper input[type="text"] {
            padding-left: 24px;
            width: 100%;
            box-sizing: border-box;
            font-size: 0.9rem;
            height: 28px;
        }
        .location-input-wrapper svg.pencil-icon {
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            fill: gray;
            pointer-events: none;
        }
        /* Update button with check icon */
        .btn-edit {
            background: #27ae60;
            padding: 5px 10px;
            color: white;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.85rem;
            height: 30px;
        }
        .btn-edit svg.check-icon {
            fill: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📥 Upload Image</h2>

    <?php foreach ([$uploadMessage, $deleteMessage, $editMessage] as $msg): ?>
        <?php if ($msg): ?>
            <div class="message"><?= $msg ?></div>
        <?php endif; ?>
    <?php endforeach; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="text" name="location" placeholder="Location (e.g. Colombo)" required>
        <button type="submit" name="upload">Upload Image</button>
    </form>

    <h2>🖼️ Uploaded Images</h2>

    <?php if (count($images) === 0): ?>
        <p>No images uploaded.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Filename</th>
                    <th>Location</th>
                    <th>Uploaded</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($images as $img): ?>
                <tr>
                    <td><img src="<?= $urlPath . htmlspecialchars($img['imgname']) ?>" alt=""></td>
                    <td><?= htmlspecialchars($img['imgname']) ?></td>
                    <td>
                        <form method="POST" class="edit-form">
                            <input type="hidden" name="id" value="<?= $img['id'] ?>">
                            <div class="location-input-wrapper">
                                <input 
                                    type="text" 
                                    name="new_location" 
                                    value="<?= htmlspecialchars($img['location']) ?>" 
                                    required
                                    aria-label="Edit location for <?= htmlspecialchars($img['imgname']) ?>"
                                >
                            </div>
                            <button type="submit" name="update_location" class="btn-edit" title="Update Location">
                                <svg class="pencil-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16">
                                    <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-8 8a.5.5 0 0 1-.168.11l-4 1.5a.5.5 0 0 1-.65-.65l1.5-4a.5.5 0 0 1 .11-.168l8-8zM11.207 2L3 10.207V11h.793L13 3.793 11.207 2z"/>
                                </svg>
                                Update
                            </button>
                        </form>
                    </td>
                    <td><?= htmlspecialchars($img['uploaded_at']) ?></td>
                    <td>
                        <a href="gallery.php?delete=<?= $img['id'] ?>" class="btn-delete" onclick="return confirm('Delete this image?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
</body>
</html>
