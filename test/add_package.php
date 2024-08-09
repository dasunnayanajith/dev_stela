<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO packages (name, description, price) VALUES ('$name', '$description', '$price')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Package</title>
</head>
<body>
    <h1>Add Package</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <label for="price">Price:</label>
        <input type="text" name="price" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>
