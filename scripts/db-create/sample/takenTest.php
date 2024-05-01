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
// Sample data for the TakenTest table
$takenTestData = array(
    array('dateTaken' => '300422120000', 'studentId' => 1, 'rightAnswer' => 20, 'timeTaken' => 45, 'takenQuestion' => '[1, 2, 3, 4, 5]'),
    array('dateTaken' => '010523093000', 'studentId' => 2, 'rightAnswer' => 18, 'timeTaken' => 60, 'takenQuestion' => '[6, 7, 8, 9]'),
    array('dateTaken' => '080623084500', 'studentId' => 3, 'rightAnswer' => 22, 'timeTaken' => 50, 'takenQuestion' => '[10, 11, 12, 13]'),
    array('dateTaken' => '150723071500', 'studentId' => 4, 'rightAnswer' => 19, 'timeTaken' => 55, 'takenQuestion' => '[14, 15, 16]'),
    array('dateTaken' => '220823103000', 'studentId' => 5, 'rightAnswer' => 21, 'timeTaken' => 40, 'takenQuestion' => '[17, 18, 19]')
);

// Insert sample data into the TakenTest table
foreach ($takenTestData as $takenTest) {
    $dateTaken = $takenTest['dateTaken'];
    $studentId = $takenTest['studentId'];
    $rightAnswer = $takenTest['rightAnswer'];
    $timeTaken = $takenTest['timeTaken'];
    $takenQuestion = $takenTest['takenQuestion'];

    $sql = "INSERT INTO TakenTest (dateTaken, studentId, rightAnswer, timeTaken, takenQuestion) VALUES ('$dateTaken', '$studentId', '$rightAnswer', '$timeTaken', '$takenQuestion')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into TakenTest table successfully<br>";
    } else {
        echo "Error inserting sample data into TakenTest table: " . mysqli_error($conn) . "<br>";
    }
}