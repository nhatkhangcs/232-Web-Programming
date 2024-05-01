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

// Sample data for Teacher table
$teacherData = [
    ['teachername1', 'password1', 'Mr. Anderson', 'anderson@example.com', 'teacher_profile1.jpg', '[101, 103, 105]'],
    ['teachername2', 'password2', 'Ms. Thompson', 'thompson@example.com', 'teacher_profile2.jpg', '[102, 104]'],
    ['teachername3', 'password3', 'Dr. Smith', 'smith@example.com', 'teacher_profile3.jpg', '[101, 102, 103]'],
    ['teachername4', 'password4', 'Mrs. Davis', 'davis@example.com', 'teacher_profile4.jpg', '[104, 105]'],
    ['teachername5', 'password5', 'Prof. Wilson', 'wilson@example.com', 'teacher_profile5.jpg', '[101, 102, 104]']
];

// Insert sample data into Teacher table
foreach ($teacherData as $teacher) {
    $sql = "INSERT INTO Teacher (userName, password, name, email, profileImage, ownCourse) 
            VALUES ('$teacher[0]', '$teacher[1]', '$teacher[2]', '$teacher[3]', '$teacher[4]', '$teacher[5]')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted into Teacher table successfully<br>";
    } else {
        echo "Error inserting record into Teacher table: " . mysqli_error($conn) . "<br>";
    }
}