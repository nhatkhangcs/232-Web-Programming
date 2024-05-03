<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS testsmart";
if ($conn->query($sql) === TRUE) {
    echo "<script>console.log('Database created successfully');</script>";
} else {
    echo "<script>console.log('Error creating database: " . $conn->error . "');</script>";
}
?>