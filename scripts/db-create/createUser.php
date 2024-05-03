<?php
// Database connection settings
include 'db-config.php';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create Student table
$sql = "CREATE TABLE IF NOT EXISTS Student (
    studentId INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    profileImage VARCHAR(255),
    testTaken TEXT -- Storing takentest IDs as JSON array
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Student created successfully<br>";
} else {
    echo "Error creating table Student: " . mysqli_error($conn) . "<br>";
}

// Create Teacher table
$sql = "CREATE TABLE IF NOT EXISTS Teacher (
    teacherId INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    profileImage VARCHAR(255),
    ownCourse TEXT -- Storing course IDs as JSON array
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Teacher created successfully<br>";
} else {
    echo "Error creating table Teacher: " . mysqli_error($conn) . "<br>";
}

// Create Admin table
$sql = "CREATE TABLE IF NOT EXISTS Admin (
    adminId INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    profileImage VARCHAR(255)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Admin created successfully<br>";
} else {
    echo "Error creating table Admin: " . mysqli_error($conn) . "<br>";
}

// Close the database connection
mysqli_close($conn);
?>
