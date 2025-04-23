<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100dvh;
            width: 100dvw;
            color: whitesmoke;
            font-family: 'Courier New', Courier, monospace;
            background-image: url('assets/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 80px;
        }

        #upload-form {
            width: 90%;
            max-width: 500px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgb(0, 0, 0);
            text-align: center;
        }

        #upload-form input[type="file"],
        #upload-form textarea,
        #upload-form button {
            width: 100%;
        }

        #upload-form textarea {
            min-height: 100px;
            resize: vertical;
        }

        #upload-form button {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 fixed-top w-100">
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
                <h5 class="offcanvas-title text-light">
                    <img src="assets/logo.png" alt="Logo" width="30" height="24"> Farmer.in
                </h5>
                <button class="btn-close bg-danger" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <a class="btn btn-warning w-100 my-2" href="home01.php">⇤ Home</a>
                <a class="btn btn-warning w-100 my-2" href="my_posts.php">My post ⚒️</a>
                <a class="btn btn-warning w-100 my-2" href="home.php">Upload</a>
                <a class="btn btn-danger w-100 my-2" href="logout.php">Logout</a>
            </div>
        </div>

        <!-- Desktop Nav -->
        <div class="collapse navbar-collapse d-none d-lg-flex align-items-center">
            <div class="ms-auto d-flex align-items-center">
                <a class="btn btn-warning btn-sm me-2" href="home01.php">Home🏡</a>
                <a class="btn btn-warning btn-sm me-2" href="my_posts.php">My post ⚒️</a>
                <a class="btn btn-outline-light btn-sm me-2" href="home.php">Blog 🚀</a>
                <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div id="upload-form">
    <h2>Upload New Image Post</h2>
    <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" class="form-control" name="image" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="description" placeholder="Enter a description..." required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>
</div>

</body>
</html>
