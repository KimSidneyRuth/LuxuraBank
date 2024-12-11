<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php"); // Redirect to the login page
    exit();
}
?>
