<?php

// Generate sample data for the taken test
$takenTest = array(
    "totalquestion" => 20, // Total number of questions
    "rightanswer" => 15, // Number of correct answers
    "time_taken" => 23, // Time taken in minutes
    "test_name" => "Sample Test", // Name of the test
    "testid" => 123, // Test ID
    "course_name" => "Sample Course", // Name of the course
    "courseid" => 456 // Course ID
);

// Convert the array to JSON format
$takenTestJSON = json_encode($takenTest);

// Output the JSON data
header('Content-Type: application/json');
echo $takenTestJSON;
