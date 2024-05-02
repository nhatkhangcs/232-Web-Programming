<?php
// Database connection settings
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sample data for Student table
$studentData = [
    ['username1', 'password1', 'John Doe', 'john@example.com', 'profile1.jpg', '[1, 3, 5]'],
    ['username2', 'password2', 'Jane Smith', 'jane@example.com', 'profile2.jpg', '[2, 4]'],
    ['username3', 'password3', 'Michael Johnson', 'michael@example.com', 'profile3.jpg', '[1, 2, 3]'],
    ['username4', 'password4', 'Emily Brown', 'emily@example.com', 'profile4.jpg', '[4, 5]'],
    ['username5', 'password5', 'David Wilson', 'david@example.com', 'profile5.jpg', '[1, 2, 4]']
];

// Insert sample data into Student table
foreach ($studentData as $student) {
    $sql = "INSERT INTO Student (userName, password, name, email, profileImage, testTaken) 
            VALUES ('$student[0]', '$student[1]', '$student[2]', '$student[3]', '$student[4]', '$student[5]')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted into Student table successfully<br>";
    } else {
        echo "Error inserting record into Student table: " . mysqli_error($conn) . "<br>";
    }
}