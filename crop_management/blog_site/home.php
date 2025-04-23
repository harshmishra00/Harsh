<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$posts = mysqli_query($conn, "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Image Feed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap for navbar only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* General Page Styles */
        body {
            background: linear-gradient(135deg,rgb(100, 153, 118),rgb(136, 169, 146),rgb(140, 202, 148));

            font-family: Arial, sans-serif;
            margin: 0;
            padding: 5rem 0 0 0;
            height:100dvh;
            width:100dvw;
            background-repeat:no-repeat;
            background-attachment:fixed;
            background-size:cover;
        }

        .container-custom {
            width: 85%;
            margin: auto;
            padding: 1rem;
            display: flex;
            flex-wrap:wrap;
            flex-direction:row;
            justify-content: center;
            align-items: center;
        }

        .post {
            background-color:rgba(54, 49, 49, 0.34);
            border-radius: 8px;
            margin: 1rem;
            box-shadow: 0px 0px 10px rgb(0, 0, 0);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            /* gap: 2rem; */
            /* flex-wrap: wrap; */
            width: 40%;
            max-height: 40rem;
            overflow-y: auto;
        }

        .post-image {
            flex: 1 1 30px;
            text-align: center;
            /* box-shadow: 0px 0px 10px rgb(0, 0, 0); */
        }

        .post-image img {
            max-width: 90%;
            border-radius: 2em;
        }

        .post-content {
            flex: 1 1 300px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            

        }

        .comments {
            background-color: rgba(0, 0, 0, 0.39);
            padding: 1rem;
            border-radius: 6px;
            max-height: 25rem;
            overflow-y: auto;
            color:whitesmoke;
        }

        .comment-form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .comment-form input[type="text"] {
            flex: 1 1 auto;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .comment-form input[type="submit"] {
            background-color: #198754;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form input[type="submit"]:hover {
            background-color: #157347;
        }


        @media (max-width: 768px) {
            .post {
                flex-direction: column;
                width: 100%;
            }
            .post-image img {
            max-width: 90%;
            border-radius: 8px;
        }
        .container-custom {
            width: 100%;
            margin:0;
        }
        }
    </style>
</head>
<body>

<!-- Bootstrap Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-opacity-75 bg-success fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand text-light" href="#">
      <img src="assets/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Farmer.in
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Mobile Offcanvas -->
    <div class="offcanvas offcanvas-end d-lg-none w-50 bg-dark text-success" id="mobileMenu">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title text-light"><img src="assets/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">Farmer.in</h5>
        <button class="btn-close bg-danger" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <!-- <p class="mb-2"><strong>Welcome, <?= htmlspecialchars($username) ?>!</strong></p> -->

        <a class="btn btn-warning w-100 my-2" href="home01.php">⇤ Home</a>
        <a class="btn btn-warning w-100 my-2" href="my_posts.php">My post ⚒️</a>
        <a class="btn btn-warning w-100 my-2" href="upload_post.php">Upload</a>
        <a class="btn btn-danger w-100 my-2" href="logout.php">Logout</a>
      </div>
    </div>

    <!-- Desktop Nav -->
    <div class="collapse navbar-collapse d-none d-lg-flex align-items-center">
      
      <div class="ms-auto d-flex align-items-center">
        <!-- <span class="text-white me-3">Welcome, <?= htmlspecialchars($username) ?>!</span> -->
        <a class="btn btn-warning btn-sm me-2" href="home01.php">Home🏡</a>
        <a class="btn btn-warning btn-sm me-2" href="my_posts.php">My post ⚒️</a>
        <a class="btn btn-outline-light btn-sm me-2" href="upload_post.php">Upload 🚀</a>
        <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>

<!-- MAIN CONTENT -->
<div class="container-custom">
    <?php while ($post = mysqli_fetch_assoc($posts)) { ?>
        <div class="post">
            <div class="post-image">
                <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="Post Image">
            </div>
            <div class="post-content">
                <p class="text-light"><strong><?= htmlspecialchars($post['username']) ?>:</strong></p>
                <p class="text-light"><?= htmlspecialchars($post['description']) ?></p>

                <!-- Comments -->
                <div class="comments">
                    <strong>Comments:</strong>
                    <?php
                    $post_id = $post['id'];
                    $comments = mysqli_query($conn, "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = $post_id ORDER BY comments.created_at ASC");
                    while ($comment = mysqli_fetch_assoc($comments)) {
                        echo "<p><h6>" . htmlspecialchars($comment['username']) . ":</h6> " . htmlspecialchars($comment['comment']) . "</p>";
                    }
                    ?>
                </div>

                <!-- Comment Form -->
                <form method="POST" action="add_comment.php" class="comment-form mt-2">
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                    <input type="text" name="comment" placeholder="Write a comment..." required>
                    <input type="submit" value="Comment">
                </form>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
