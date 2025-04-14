<?php
$conn = mysqli_connect("localhost", "root", "", "social_app");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
