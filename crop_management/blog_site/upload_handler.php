<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_FILES['image']) && isset($_POST['description'])) {
    $imgName = $_FILES['image']['name'];
    $imgTmp = $_FILES['image']['tmp_name'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $fileName = time() . '_' . basename($imgName);
    $imgPath = $uploadDir . $fileName;

    if (move_uploaded_file($imgTmp, $imgPath)) {
        $sql = "INSERT INTO posts (user_id, image_path, description) VALUES ('$user_id', '$imgPath', '$description')";
        if (mysqli_query($conn, $sql)) {
            header("Location: home.php");
        } else {
            echo "Error saving post.";
        }
    } else {
        echo "Image upload failed.";
    }
} else {
    echo "Invalid request.";
}
?>
