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
// Sample data for the TakenQuestion table
$takenQuestionData = array(
    array('testId' => 1, 'chosen' => true, 'chosenOption' => 'optionA'),
    array('testId' => 1, 'chosen' => false, 'chosenOption' => ''),
    array('testId' => 2, 'chosen' => true, 'chosenOption' => 'optionC'),
    array('testId' => 2, 'chosen' => true, 'chosenOption' => 'optionB'),
    array('testId' => 3, 'chosen' => true, 'chosenOption' => 'optionD')
);

// Insert sample data into the TakenQuestion table
foreach ($takenQuestionData as $takenQuestion) {
    $testId = $takenQuestion['testId'];
    $chosen = $takenQuestion['chosen'] ? 1 : 0; // Convert boolean to integer
    $chosenOption = $takenQuestion['chosenOption'];

    $sql = "INSERT INTO TakenQuestion (testId, chosen, chosenOption) VALUES ('$testId', '$chosen', '$chosenOption')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into TakenQuestion table successfully<br>";
    } else {
        echo "Error inserting sample data into TakenQuestion table: " . mysqli_error($conn) . "<br>";
    }
}