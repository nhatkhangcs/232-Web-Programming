<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameter 'auth_key' is set in the request headers
    if (isset($_SERVER['HTTP_AUTH_KEY'])) {
        // Extract the auth_key from the request headers
        $auth_key = $_SERVER['HTTP_AUTH_KEY'];

        // Check if the auth_key is valid (you should implement your own authentication mechanism)
        // For example, you can compare the auth_key with a stored key in your database or a predefined key
        $valid_auth_key = 'your_valid_auth_key';
        if ($auth_key !== $valid_auth_key) {
            http_response_code(401);
            echo json_encode(array("error" => "Unauthorized access"));
            exit();
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing auth_key in request headers"));
        exit();
    }

    // Check if the required parameters are set in the request body
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['testid']) && isset($data['studentid']) && isset($data['time_taken']) && isset($data['taken_question'])) {
        // Extract the parameters from the request body
        $testid = $data['testid'];
        $studentid = $data['studentid'];
        $time_taken = $data['time_taken'];
        $taken_question = $data['taken_question'];

        // Establishing the database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            http_response_code(500);
            echo json_encode(array("error" => "Database connection failed"));
            exit();
        }

        // Prepare SQL query to insert the taken test into the database
        $sql = "INSERT INTO TakenTest (testId, studentId, timeTaken) VALUES ('$testid', '$studentid', '$time_taken')";

        // Execute SQL query to insert the taken test
        if (mysqli_query($conn, $sql)) {
            // Get the ID of the inserted taken test
            $takentestid = mysqli_insert_id($conn);

            // Prepare SQL query to insert taken questions into the database
            foreach ($taken_question as $question) {
                $chosen_option = $question['chosen_option'];
                $sql_question = "INSERT INTO TakenQuestion (testId, takentestId, chosenOption) VALUES ('$testid', '$takentestid', '$chosen_option')";
                mysqli_query($conn, $sql_question);
            }

            // Close database connection
            mysqli_close($conn);

            // Return success response with the ID of the inserted taken test
            http_response_code(200);
            echo json_encode(array("success" => "Attempt saved successfully.", "takentestid" => $takentestid));
        } else {
            // Close database connection
            mysqli_close($conn);

            // Return error response if insertion fails
            http_response_code(500);
            echo json_encode(array("error" => "Something went wrong. Please try again later."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing testid, studentid, time_taken, or taken_question parameter in request body"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
