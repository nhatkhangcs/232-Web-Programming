<?php
// Database connection settings
include '../db-config.php';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sample data for Admin table
$adminData = [
    ['admin1', 'password1', 'Admin 1', 'admin1@example.com', 'admin_profile1.jpg'],
    ['admin2', 'password2', 'Admin 2', 'admin2@example.com', 'admin_profile2.jpg'],
    ['admin3', 'password3', 'Admin 3', 'admin3@example.com', 'admin_profile3.jpg'],
    ['admin4', 'password4', 'Admin 4', 'admin4@example.com', 'admin_profile4.jpg'],
    ['admin5', 'password5', 'Admin 5', 'admin5@example.com', 'admin_profile5.jpg']
];

// Insert sample data into Admin table
foreach ($adminData as $admin) {
    $password_hash = password_hash($admin[1], PASSWORD_DEFAULT);
    $sql = "INSERT INTO Admin (userName, password, name, email, profileImage) 
            VALUES ('$admin[0]', '$password_hash', '$admin[2]', '$admin[3]', '$admin[4]')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted into Admin table successfully<br>";
    } else {
        echo "Error inserting record into Admin table: " . mysqli_error($conn) . "<br>";
    }
}

// Close the database connection
mysqli_close($conn);
?>