<?php
// Database connection settings
include '../db-config.php';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Sample data for the Question table
$questionData = array(
    array('testId' => 1, 'image' => 'image1.jpg', 'question' => 'What is 2 + 2?', 'optionA' => '3', 'optionB' => '4', 'optionC' => '5', 'optionD' => '6', 'answer' => 'optionB', 'difficultyLevel' => 'Easy'),
    array('testId' => 1, 'image' => 'image2.jpg', 'question' => 'What is the capital of France?', 'optionA' => 'London', 'optionB' => 'Paris', 'optionC' => 'Berlin', 'optionD' => 'Madrid', 'answer' => 'optionB', 'difficultyLevel' => 'Easy'),
    array('testId' => 1, 'image' => 'image3.jpg', 'question' => 'Who wrote "Romeo and Juliet"?', 'optionA' => 'William Shakespeare', 'optionB' => 'Charles Dickens', 'optionC' => 'Jane Austen', 'optionD' => 'Mark Twain', 'answer' => 'optionA', 'difficultyLevel' => 'Medium'),
    array('testId' => 1, 'image' => 'image4.jpg', 'question' => 'What is the chemical symbol for water?', 'optionA' => 'O', 'optionB' => 'H', 'optionC' => 'W', 'optionD' => 'H2O', 'answer' => 'optionD', 'difficultyLevel' => 'Medium'),
    array('testId' => 1, 'image' => 'image5.jpg', 'question' => 'Who discovered gravity?', 'optionA' => 'Isaac Newton', 'optionB' => 'Albert Einstein', 'optionC' => 'Galileo Galilei', 'optionD' => 'Nikola Tesla', 'answer' => 'optionA', 'difficultyLevel' => 'Hard')
);

// Insert sample data into the Question table
foreach ($questionData as $question) {
    $testId = $question['testId'];
    $image = $question['image'];
    $questionText = $question['question'];
    $optionA = $question['optionA'];
    $optionB = $question['optionB'];
    $optionC = $question['optionC'];
    $optionD = $question['optionD'];
    $answer = $question['answer'];
    $difficultyLevel = $question['difficultyLevel'];

    $sql = "INSERT INTO Question (testId, image, question, optionA, optionB, optionC, optionD, answer, difficultyLevel) VALUES ('$testId', '$image', '$questionText', '$optionA', '$optionB', '$optionC', '$optionD', '$answer', '$difficultyLevel')";
    if (mysqli_query($conn, $sql)) {
        echo "Sample data inserted into Question table successfully<br>";
    } else {
        echo "Error inserting sample data into Question table: " . mysqli_error($conn) . "<br>";
    }
}