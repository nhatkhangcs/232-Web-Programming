<?php
// Database connection settings
include '../db-config.php';


// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Sample data for the TakenQuestion table
$takenQuestionData = array(
    array("questionId" => 1, "takenTestId" => 1, "chosenOption" => "Option A"),
    array("questionId" => 2, "takenTestId" => 1, "chosenOption" => "Option B"),
    array("questionId" => 3, "takenTestId" => 1, "chosenOption" => ""),
    array("questionId" => 4, "takenTestId" => 1, "chosenOption" => "Option D"),
    array("questionId" => 5, "takenTestId" => 1, "chosenOption" => "Option A")
);

// Insert sample data into the TakenQuestion table
foreach ($takenQuestionData as $data) {
    $questionId = $data['questionId'];
    $takenTestId = $data['takenTestId'];
    $chosenOption = $data['chosenOption'];

    $sql = "INSERT INTO TakenQuestion (questionId, takenTestId, chosenOption) VALUES ('$questionId', '$takenTestId', '$chosenOption')";

    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into TakenQuestion table successfully<br>";
    } else {
        echo "Error inserting sample data into TakenQuestion table: " . mysqli_error($conn) . "<br>";
    }
}