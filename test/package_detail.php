<?php
include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM packages WHERE id = $id";
$result = $conn->query($sql);
$package = $result->fetch_assoc();

$sql_images = "SELECT * FROM package_images WHERE package_id = $id";
$result_images = $conn->query($sql_images);

$sql_activities = "SELECT * FROM activities WHERE package_id = $id ORDER BY activity_date";
$result_activities = $conn->query($sql_activities);

$sql_tags = "SELECT t.tag_name FROM tags t
             JOIN package_tags pt ON t.id = pt.tag_id
             WHERE pt.package_id = $id";
$result_tags = $conn->query($sql_tags);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $package['name']; ?></title>
</head>
<body>
    <h1><?php echo $package['name']; ?></h1>
    <p><?php echo $package['description']; ?></p>
    <p>Price: <?php echo $package['price']; ?></p>

    <h2>Images</h2>
    <ul>
        <?php while($row = $result_images->fetch_assoc()): ?>
            <li><img src="<?php echo $row['image_url']; ?>" alt="Package Image"></li>
        <?php endwhile; ?>
    </ul>

    <h2>Activities</h2>
    <ul>
        <?php while($row = $result_activities->fetch_assoc()): ?>
            <li><?php echo $row['activity_date']; ?>: <?php echo $row['activity_description']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Tags</h2>
    <ul>
        <?php while($row = $result_tags->fetch_assoc()): ?>
            <li><?php echo $row['tag_name']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
