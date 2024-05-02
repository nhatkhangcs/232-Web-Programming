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
// Sample data for the Test table
$testData = array(
    array('description' => 'Midterm Exam', 'question' => '[1, 2, 3, 4]', 'timeLimit' => 60),
    array('description' => 'Final Exam', 'question' => '[5, 6, 7]', 'timeLimit' => 90),
    array('description' => 'Quiz 1', 'question' => '[8, 9, 10]', 'timeLimit' => 30),
    array('description' => 'Quiz 2', 'question' => '[11, 12]', 'timeLimit' => 45),
    array('description' => 'Practice Test', 'question' => '[13, 14, 15, 16]', 'timeLimit' => 60)
);

// Insert sample data into the Test table
foreach ($testData as $key => $test) {
    $description = $test['description'];
    $question = $test['question'];
    $timeLimit = $test['timeLimit'];

    $sql = "INSERT INTO Test (description, question, timeLimit) VALUES ('$description', '$question', '$timeLimit')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into Test table successfully<br>";
    } else {
        echo "Error inserting sample data into Test table: " . mysqli_error($conn) . "<br>";
    }
}