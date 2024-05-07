<?php
// Database connection settings
include '../db-config.php';


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Sample data for the Test table
$testData = array(
    array('name' => 'Math 1', 'courseId' => 1, 'description' => 'Midterm Exam', 'timeLimit' => 60),
    array('name' => 'Math 2', 'courseId' => 2, 'description' => 'Final Exam', 'timeLimit' => 90),
    array('name' => 'Math 3', 'courseId' => 3, 'description' => 'Quiz 1', 'timeLimit' => 30),
    array('name' => 'Math 4', 'courseId' => 3, 'description' => 'Quiz 2', 'timeLimit' => 45),
    array('name' => 'Math 5', 'courseId' => 4, 'description' => 'Practice Test', 'timeLimit' => 60)
);

// Insert sample data into the Test table
foreach ($testData as $key => $test) {
    $name = $test['name'];
    $courseId = $test['courseId'];
    $description = $test['description'];
    $timeLimit = $test['timeLimit'];

    $sql = "INSERT INTO Test (name, courseId, description, timeLimit) VALUES ('$name', '$courseId', '$description', '$timeLimit')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into Test table successfully<br>";
    } else {
        echo "Error inserting sample data into Test table: " . mysqli_error($conn) . "<br>";
    }
}