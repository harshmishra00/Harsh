<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = intval($_POST['post_id']);
$comment = mysqli_real_escape_string($conn, $_POST['comment']);

if ($comment !== '') {
    // Prevent duplicate exact same comment from same user on same post
    $sql = "INSERT IGNORE INTO comments (post_id, user_id, comment) VALUES ('$post_id', '$user_id', '$comment')";
    mysqli_query($conn, $sql);
}

header("Location: home.php");
exit();
?>
