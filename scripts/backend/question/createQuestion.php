<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameters are set in the request body
    if (
        isset($_POST['auth_key']) &&
        isset($_POST['testid']) &&
        isset($_POST['image']) &&
        isset($_POST['question']) &&
        isset($_POST['optionA']) &&
        isset($_POST['optionB']) &&
        isset($_POST['optionC']) &&
        isset($_POST['optionD']) &&
        isset($_POST['answer']) &&
        isset($_POST['difficulty'])
    ) {
        // Extract the parameters from the request body
        $auth_key = $_POST['auth_key'];
        $testid = $_POST['testid'];
        $image = $_POST['image'];
        $question = $_POST['question'];
        $optionA = $_POST['optionA'];
        $optionB = $_POST['optionB'];
        $optionC = $_POST['optionC'];
        $optionD = $_POST['optionD'];
        $answer = $_POST['answer'];
        $difficulty = $_POST['difficulty'];

        // Check if the auth_key is valid (you should implement your own authentication mechanism)
        // For example, you can compare the auth_key with a stored key in your database or a predefined key
        $valid_auth_key = 'your_valid_auth_key';
        if ($auth_key !== $valid_auth_key) {
            http_response_code(401);
            echo json_encode(array("error" => "Unauthorized access"));
            exit();
        }

        // Establishing the database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            http_response_code(500);
            echo json_encode(array("error" => "Database connection failed"));
            exit();
        }

        // Prepare SQL query to insert the question into the database
        $sql = "INSERT INTO Question (testId, image, question, optionA, optionB, optionC, optionD, answer, difficulty) VALUES ('$testid', '$image', '$question', '$optionA', '$optionB', '$optionC', '$optionD', '$answer', '$difficulty')";

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            http_response_code(200);
            echo json_encode(array("success" => "Question created successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Something went wrong. Please try again later."));
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing required parameters"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
