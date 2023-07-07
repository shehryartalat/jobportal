<?php


session_start();
if (isset($_SESSION['user_id'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect the user to the login page
header("Location: /jobportal/login.php");
exit();
?>