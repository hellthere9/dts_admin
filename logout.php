<?php
session_start(); // Start the session

// Include the database connection
include 'roxcon.php';

// Destroy the session
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
