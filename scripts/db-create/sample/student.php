<?php
// Database connection settings
include '../db-config.php';


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sample data for Student table
$studentData = [
    array("userName" => "student7", "password" => "password1", "name" => "John Doe", "email" => "john@example.com", "profileImage" => "profile1.jpg"),
    array("userName" => "student8", "password" => "password2", "name" => "Jane Smith", "email" => "jane@example.com", "profileImage" => "profile2.jpg"),
    array("userName" => "student9", "password" => "password3", "name" => "Michael Johnson", "email" => "michael@example.com", "profileImage" => "profile3.jpg"),
    array("userName" => "student10", "password" => "password4", "name" => "Emily Brown", "email" => "emily@example.com", "profileImage" => "profile4.jpg"),
    array("userName" => "student11", "password" => "password5", "name" => "David Wilson", "email" => "david@example.com", "profileImage" => "profile5.jpg")
];

// Insert sample data into Student table
foreach ($studentData as $student) {
    $password_hash = password_hash($student['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO Student (userName, password, name, email, profileImage) 
            VALUES ('$student[userName]', '$password_hash', '$student[name]', '$student[email]', '$student[profileImage]')";
            

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted into Student table successfully<br>";
    } else {
        echo "Error inserting record into Student table: " . mysqli_error($conn) . "<br>";
    }
}