<?php
// Start the session
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if session exists
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();
    
    // Regenerate session ID for security
    session_regenerate_id(true);
    
    // Destroy the session
    session_destroy();
}

// Redirect to login page
header("Location: login.php");
exit();
?>