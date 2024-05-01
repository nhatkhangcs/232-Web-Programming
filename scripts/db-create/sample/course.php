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
// Sample data for the Course table
$courseData = array(
    array('name' => 'Mathematics', 'teacherId' => 1, 'Test' => 4, 'description' => 'Basic mathematics course'),
    array('name' => 'English Literature', 'teacherId' => 2, 'Test' => 3, 'description' => 'Introduction to English literature'),
    array('name' => 'Computer Science', 'teacherId' => 3, 'Test' => 5, 'description' => 'Fundamentals of computer science'),
    array('name' => 'History', 'teacherId' => 4, 'Test' => 3, 'description' => 'World history overview'),
    array('name' => 'Physics', 'teacherId' => 5, 'Test' => 4, 'description' => 'Introduction to physics')
);

// Insert sample data into the Course table
foreach ($courseData as $course) {
    $name = $course['name'];
    $teacherId = $course['teacherId'];
    $Test = $course['Test'];
    $description = $course['description'];

    $sql = "INSERT INTO Course (name, teacherId, Test, description) VALUES ('$name', '$teacherId', '$Test', '$description')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into Course table successfully<br>";
    } else {
        echo "Error inserting sample data into Course table: " . mysqli_error($conn) . "<br>";
    }
}