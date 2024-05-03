<?php
// Database connection settings
include '../db-config.php';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Sample data for the Course table
$courseData = array(
    array("name" => "Mathematics", "teacherId" => 1, "Test" => json_encode([1]), "description" => "Introduction to mathematics"),
    array("name" => "Physics", "teacherId" => 2, "Test" => json_encode([2]), "description" => "Introduction to physics"),
    array("name" => "Biology", "teacherId" => 3, "Test" => json_encode([3]), "description" => "Introduction to biology"),
    array("name" => "Chemistry", "teacherId" => 3, "Test" => json_encode([4,5]), "description" => "Introduction to chemistry"),
    array("name" => "Computer Science", "teacherId" => 4, "Test" => json_encode([]), "description" => "Introduction to computer science")
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