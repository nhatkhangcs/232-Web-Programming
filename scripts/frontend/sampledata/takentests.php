<?php

if (!isset($_GET['takentestid'])) {
    // If the takentestid parameter is not set, return an error message
    echo "Error: takentestid parameter not set";
    exit();
}
if (!isset($_GET['review'])) {
    // If the review parameter is not set, return an error message
    echo "Error: review parameter not set";
    exit();
}
$review = $_GET['review'];
if ($review != "true") {

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
}
elseif ($review == "true") {
    // Generate sample data for the review page
    // Sample data for the taken test
    $takenTest = array(
        "test_name" => "Sample Test", // Name of the test
        "testid" => 123, // Test ID
        "course_name" => "Sample Course", // Name of the course
        "courseid" => 456, // Course ID
        "time_taken" => "45 minutes", // Time taken (in minutes)
        "timelimit" => "60 minutes", // Time limit (in minutes)
        "taken_questions" => array(
            array(
                "image" => "image_url_1.jpg", // Image URL (if available)
                "question" => "Sample question 1",
                "optionA" => "Option A",
                "optionB" => "Option B",
                "optionC" => "Option C",
                "optionD" => "Option D",
                "answer" => "A", // Correct answer
                "chosen_option" => "B", // Chosen option by the user
                "difficulty" => "Medium"
            ),
            array(
                "image" => "image_url_2.jpg", // Image URL (if available)
                "question" => "Sample question 2",
                "optionA" => "Option A",
                "optionB" => "Option B",
                "optionC" => "Option C",
                "optionD" => "Option D",
                "answer" => "C", // Correct answer
                "chosen_option" => "C", // Chosen option by the user
                "difficulty" => "Hard"
            ),
            array(
                "image" => "image_url_3.jpg", // Image URL (if available)
                "question" => "Sample question 3",
                "optionA" => "Option A",
                "optionB" => "Option B",
                "optionC" => "Option C",
                "optionD" => "Option D",
                "answer" => "B", // Correct answer
                "chosen_option" => "A", // Chosen option by the user
                "difficulty" => "Easy"
            ),
            array(
                "image" => "image_url_4.jpg", // Image URL (if available)
                "question" => "Sample question 4",
                "optionA" => "Option A",
                "optionB" => "Option B",
                "optionC" => "Option C",
                "optionD" => "Option D",
                "answer" => "C", // Correct answer
                "chosen_option" => "D", // Chosen option by the user
                "difficulty" => "Medium"
            ),
            array(
                "image" => "image_url_5.jpg", // Image URL (if available)
                "question" => "Sample question 5",
                "optionA" => "Option A",
                "optionB" => "Option B",
                "optionC" => "Option C",
                "optionD" => "Option D",
                "answer" => "D", // Correct answer
                "chosen_option" => "C", // Chosen option by the user
                "difficulty" => "Hard"
            ),
            // Add more questions here...
        )
    );

    // Convert the array to JSON format
    $takenTestJSON = json_encode($takenTest, JSON_PRETTY_PRINT);

    // Output the JSON data
    header('Content-Type: application/json');
    echo $takenTestJSON;
}
?>
