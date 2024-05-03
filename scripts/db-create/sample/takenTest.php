<?php
// Database connection settings
include '../db-config.php';


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Sample data for the TakenTest table
$takenTestData = array(
    array("testId" => 1, "dateTaken" => "010124120000", "studentId" => 1, "takenQuestion" => json_encode([1, 2, 3, 4, 5]), "timeTaken" => 22),
    array("testId" => 2, "dateTaken" => "020224130000", "studentId" => 2, "takenQuestion" => json_encode([6]), "timeTaken" => 12),
    array("testId" => 3, "dateTaken" => "030324140000", "studentId" => 3, "takenQuestion" => json_encode([7, 8, 9]), "timeTaken" => 44),
    array("testId" => 4, "dateTaken" => "040424150000", "studentId" => 3, "takenQuestion" => json_encode([10, 11, 12]), "timeTaken" => 15),
    array("testId" => 5, "dateTaken" => "050524160000", "studentId" => 4, "takenQuestion" => json_encode([13, 14, 15]), "timeTaken" => 20)
);

// Insert sample data into the TakenTest table
foreach ($takenTestData as $takenTest) {
    $testId = $takenTest['testId'];
    $dateTaken = $takenTest['dateTaken'];
    $studentId = $takenTest['studentId'];
    $timeTaken = $takenTest['timeTaken'];
    $takenQuestion = $takenTest['takenQuestion'];

    $sql = "INSERT INTO TakenTest (testId, dateTaken, studentId, timeTaken, takenQuestion) VALUES ('$testId', '$dateTaken', '$studentId', '$timeTaken', '$takenQuestion')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into TakenTest table successfully<br>";
    } else {
        echo "Error inserting sample data into TakenTest table: " . mysqli_error($conn) . "<br>";
    }
}