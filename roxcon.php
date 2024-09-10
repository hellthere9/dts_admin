<?php
// Database connection details
$servername = "localhost"; // Usually 'localhost'
$username = "root";        // MySQL username (default is 'root' for XAMPP)
$password = "";            // MySQL password (default is empty for XAMPP)
$dbname = "dts";           // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>
