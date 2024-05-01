<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the required parameters are set in the URL
    if (isset($_GET['testid']) && isset($_GET['answer'])) {
        // Extract the testid and answer parameters from the URL
        $testid = $_GET['testid'];
        $include_answer = $_GET['answer'];

        // Check if the required parameter 'auth_key' is set in the URL
        if (isset($_GET['auth_key'])) {
            // Extract the auth_key from the URL
            $auth_key = $_GET['auth_key'];

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
            echo json_encode(array("error" => "Missing auth_key parameter"));
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

        // Prepare SQL query to fetch questions from the specified test
        $sql = "SELECT * FROM Question WHERE testId = $testid";
        if (!$include_answer) {
            // Exclude the 'answer' column from the query if the 'answer' parameter is set to false
            $sql = str_replace(', answer', '', $sql);
        }

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        // Check if there are any questions returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch questions and store them in an array
            $questions = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $questions[] = $row;
            }

            // Close database connection
            mysqli_close($conn);

            // Return the questions as a JSON response
            http_response_code(200);
            echo json_encode(array("questions" => $questions));
        } else {
            http_response_code(400);
            echo json_encode(array("error" => "No questions found for the specified test"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing testid or answer parameter"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
