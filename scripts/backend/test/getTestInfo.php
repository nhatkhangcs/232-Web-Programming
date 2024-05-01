<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the required parameter 'courseid' is set in the URL
    if (isset($_GET['courseid'])) {
        // Extract the courseid from the URL
        $courseid = $_GET['courseid'];

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

        // Prepare SQL query to fetch tests information based on courseid
        $sql = "SELECT testId, name AS testname, description, timeCreated, timeLimit FROM Test WHERE courseId = $courseid";

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // If query successful, fetch data
            $tests = array();
            while ($row = mysqli_fetch_assoc($result)) {
                // Fetch the questions associated with each test
                $testid = $row['testId'];
                $sql_questions = "SELECT questionId FROM Question WHERE testId = $testid";
                $result_questions = mysqli_query($conn, $sql_questions);

                $questions = array();
                while ($question_row = mysqli_fetch_assoc($result_questions)) {
                    $questions[] = $question_row['questionId'];
                }

                // Construct the test information
                $test_info = array(
                    "testname" => $row['testname'],
                    "description" => $row['description'],
                    "timeCreated" => $row['timeCreated'],
                    "timelimit" => $row['timeLimit'],
                    "questions" => $questions
                );

                $tests[] = $test_info;
            }

            // Construct the response
            $response = array("tests" => $tests);

            // Return the response as JSON
            http_response_code(200);
            echo json_encode($response);
        } else {
            // If query fails, return error response
            http_response_code(500);
            echo json_encode(array("error" => "Query execution failed"));
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        // If courseid parameter not provided in URL, return error response
        http_response_code(400);
        echo json_encode(array("error" => "Courseid parameter missing in URL"));
    }
} else {
    // If request method is not GET, return error response
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
