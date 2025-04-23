<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle delete
if (isset($_GET['delete'])) {
    $post_id = intval($_GET['delete']);
    $getImage = mysqli_query($conn, "SELECT image_path FROM posts WHERE id=$post_id AND user_id=$user_id");

    if (mysqli_num_rows($getImage) > 0) {
        $row = mysqli_fetch_assoc($getImage);
        $image_path = $row['image_path'];
        mysqli_query($conn, "DELETE FROM posts WHERE id=$post_id AND user_id=$user_id");
        if (file_exists($image_path)) unlink($image_path);
    }
    header("Location: my_posts.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM posts WHERE user_id=$user_id ORDER BY created_at DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Posts</title>
  <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background: linear-gradient(135deg, #003333, #006666, #00cccc);
      font-family: Arial, sans-serif;
      margin: 0;
      padding-top: 5rem;
      color: #fff;
      height:100dvh;
            width:100dvw;
    }

    .post-card {
      background-color: #fff;
      color: #333;
      border-radius: 8px;
      overflow: hidden;
      transition: transform 0.2s ease-in-out, box-shadow 0.2s;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .post-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
      object-fit: cover;
      height: 250px;
      width: 100%;
    }

    .delete-btn {
      transition: background-color 0.2s;
      background-color: transparent;
      border: 1px solid #dc3545;
      color: #dc3545;
      padding: 0.5rem;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    .card-footer {
      font-size: 0.9rem;
      background-color: #f8f9fa;
      padding: 0.5rem;
      text-align: end;
    }

    h2 {
      text-align: center;
      margin-bottom: 2rem;
    }
  </style>
</head>

<body>
<!-- ✅ Navbar with Bootstrap only -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#">
      <img src="assets/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Farmer.in
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end d-lg-none w-50 bg-dark text-success" id="mobileMenu">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title text-light">
          <img src="assets/logo.png" alt="Logo" width="30" height="24"> Farmer.in
        </h5>
        <button class="btn-close bg-danger" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <a class="btn btn-warning w-100 my-2" href="home.php">← blog</a>
        <a class="btn btn-warning w-100 my-2" href="upload_post.php">Upload</a>
        <a class="btn btn-danger w-100 my-2" href="logout.php">Logout</a>
      </div>
    </div>

    <div class="collapse navbar-collapse d-none d-lg-flex align-items-center">
      <div class="ms-auto d-flex align-items-center gap-2">
        <a href="home.php" class="btn btn-light btn-sm">← blog</a>
        <a href="upload_post.php" class="btn btn-light btn-sm">Upload</a>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </div>
</nav>

<!-- ✅ Main Content -->
<div class="container mt-4">
  <h2>My Posts</h2>
  <div class="row">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while($post = mysqli_fetch_assoc($result)): ?>
        <div class="col-12 col-sm-6 col-lg-4 d-flex ">
          <div class="post-card w-100 p-3">
            <img src="<?php echo htmlspecialchars($post['image_path']); ?>" class="card-img-top" alt="Post Image">
            <div class="p-3 flex-grow-1">
              <p><?php echo nl2br(htmlspecialchars($post['description'])); ?></p>
              <form method="GET" onsubmit="return confirm('Delete this post?');" >
                <input type="hidden" name="delete" value="<?php echo $post['id']; ?>">
                <button type="submit" class="btn btn-outline-danger w-75 my-3 ">Delete</button>
              </form>
            </div>
            <div class="card-footer">
              <?php echo date("d M Y, h:i A", strtotime($post['created_at'])); ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="text-center mt-5 w-100">
        <h4>No posts found. <a href="upload_post.php" class="text-decoration-none text-warning">Upload now</a></h4>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
