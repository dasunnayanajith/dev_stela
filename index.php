<?php
session_start();
error_reporting(0);
include('includes/config.php');

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page = preg_replace('/[^a-zA-Z0-9_]/', '', $page); // Sanitize input

include 'header.php';

$file = "pages/{$page}.php";
if (file_exists($file)) {
    include $file;
} else {
    include 'pages/error.php';
}

include 'footer.php';
?>
