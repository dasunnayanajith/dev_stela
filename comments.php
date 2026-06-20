<?php
// Handle comment post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $image = htmlspecialchars($_POST['image']);
    $comment = htmlspecialchars($_POST['comment']);

    $newComment = [
        "name" => $name,
        "image" => $image,
        "comment" => $comment,
    ];

    $comments = [];
    if (file_exists("comments.json")) {
        $comments = json_decode(file_get_contents("comments.json"), true);
    }
    $comments[] = $newComment;
    file_put_contents("comments.json", json_encode($comments, JSON_PRETTY_PRINT));
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Comment System</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        .comment-box { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
        .comment-author { font-weight: bold; }
        .profile-img { width: 40px; height: 40px; border-radius: 50%; vertical-align: middle; margin-right: 8px; }
        textarea { width: 100%; height: 80px; }
    </style>
</head>
<body>
    <h2>Comment Section (Google Sign-In)</h2>

    <!-- Google Sign-In -->
    <div id="g_id_onload"
         data-client_id="YOUR_GOOGLE_CLIENT_ID"
         data-callback="handleCredentialResponse"
         data-auto_prompt="false">
    </div>

    <div class="g_id_signin"
         data-type="standard"
         data-size="large"
         data-theme="outline"
         data-text="sign_in_with"
         data-shape="rectangular">
    </div>

    <!-- After login -->
    <div id="user-info" style="display:none;">
        <img id="user-pic" class="profile-img">
        <span id="user-name"></span>
        <button onclick="signOut()">Sign Out</button>
    </div>

    <!-- Comment Form -->
    <form id="comment-form" method="POST" style="display:none;">
        <input type="hidden" name="name" id="form-name">
        <input type="hidden" name="image" id="form-image">
        <textarea name="comment" placeholder="Write a comment..." required></textarea><br><br>
        <button type="submit">Post Comment</button>
    </form>

    <hr>

    <!-- Comment Display -->
    <div id="comments">
        <?php
        if (file_exists("comments.json")) {
            $comments = json_decode(file_get_contents("comments.json"), true);
            foreach (array_reverse($comments) as $c) {
                echo "<div class='comment-box'>";
                echo "<img class='profile-img' src='" . htmlspecialchars($c['image']) . "' alt='Profile'>";
                echo "<span class='comment-author'>" . htmlspecialchars($c['name']) . "</span><br>";
                echo "<p>" . nl2br(htmlspecialchars($c['comment'])) . "</p>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <script>
    function handleCredentialResponse(response) {
        const data = parseJwt(response.credential);
        document.getElementById('user-info').style.display = 'block';
        document.getElementById('user-name').innerText = data.name;
        document.getElementById('user-pic').src = data.picture;

        document.getElementById('form-name').value = data.name;
        document.getElementById('form-image').value = data.picture;
        document.getElementById('comment-form').style.display = 'block';

        document.querySelector('.g_id_signin').style.display = 'none';
    }

    function parseJwt(token) {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        return JSON.parse(decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join('')));
    }

    function signOut() {
        google.accounts.id.disableAutoSelect();
        location.reload();
    }
    </script>
</body>
</html>
