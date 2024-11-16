<?php
// Your Blogger API key
$apiKey = 'YOUR_API_KEY';

// Your Blogger blog ID
$blogId = 'YOUR_BLOG_ID';

// Blogger API URL
$url = "https://www.googleapis.com/blogger/v3/blogs/$blogId/posts?key=$apiKey";

// Fetch the blog posts using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response
$blogData = json_decode($response, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .blog-post {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .blog-post h2 {
            margin-top: 0;
        }
        .blog-post p {
            line-height: 1.6;
        }
    </style>
</head>
<body>

<h1>My Blog</h1>

<?php
// Display the blog posts
if (!empty($blogData['items'])) {
    foreach ($blogData['items'] as $post) {
        echo "<div class='blog-post'>";
        echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
        echo "<p>" . htmlspecialchars($post['content']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No posts found.</p>";
}
?>

</body>
</html>
