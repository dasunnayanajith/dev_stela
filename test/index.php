<?php
include 'config.php';

$sql = "SELECT * FROM packages";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tour Packages</title>
</head>
<body>
    <h1>Tour Packages</h1>
    <a href="add_package.php">Add Package</a>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <a href="package_detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
