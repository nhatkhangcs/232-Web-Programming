<?php
// Database connection settings
include '../db-config.php';


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sample data for Teacher table
$teacherData = array(
    array("userName" => "teacher1", "password" => "password1", "name" => "John Doe", "email" => "john@example.com", "profileImage" => "profile1.jpg"),
    array("userName" => "teacher2", "password" => "password2", "name" => "Jane Smith", "email" => "jane@example.com", "profileImage" => "profile2.jpg"),
    array("userName" => "teacher3", "password" => "password3", "name" => "Alice Johnson", "email" => "alice@example.com", "profileImage" => "profile3.jpg"),
    array("userName" => "teacher4", "password" => "password4", "name" => "Bob Brown", "email" => "bob@example.com", "profileImage" => "profile4.jpg"),
    array("userName" => "teacher5", "password" => "password5", "name" => "Emily Davis", "email" => "emily@example.com", "profileImage" => "profile5.jpg")
);

// Insert sample data into Teacher table
foreach ($teacherData as $teacher) {
    $password_hash = password_hash($teacher['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO Teacher (userName, password, name, email, profileImage) 
            VALUES ('$teacher[userName]', '$password_hash', '$teacher[name]', '$teacher[email]', '$teacher[profileImage]')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted into Teacher table successfully<br>";
    } else {
        echo "Error inserting record into Teacher table: " . mysqli_error($conn) . "<br>";
    }
}