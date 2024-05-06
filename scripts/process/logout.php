<?php
session_start();
// Destroy the session
session_destroy();
// Delete any cookies set during login
// Redirect to login page or any other desired page
header("Location: ../frontend/login_page.php");
exit();
?>