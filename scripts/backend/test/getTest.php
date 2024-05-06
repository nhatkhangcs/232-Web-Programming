<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the required parameter 'testid' is set in the URL
    if (isset($_GET['testid'])) {
        // Extract the testid from the URL
        $testid = $_GET['testid'];

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

        // Prepare SQL query to fetch test information based on testid
        $sql = "SELECT name as testname, courseId, description, timeCreated, timeLimit FROM Test WHERE testId = $testid";

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // If query successful, fetch data
            $row = mysqli_fetch_assoc($result);

            // Check if test with given id exists
            if ($row) {
                $coursename = "";
                $sql_course = "SELECT name FROM Course WHERE courseId = " . $row['courseId'];
                $result_course = mysqli_query($conn, $sql_course);
                $coursename = mysqli_fetch_assoc($result_course)['name'];

                // Fetch the questions associated with the test
                $sql_questions = "SELECT questionId FROM Question WHERE testId = $testid";
                $result_questions = mysqli_query($conn, $sql_questions);

                $questions = array();
                while ($question_row = mysqli_fetch_assoc($result_questions)) {
                    $questions[] = $question_row['questionId'];
                }

                // Construct the response
                $response = array(
                    "testname" => $row['testname'],
                    "coursename" => $coursename,
                    "courseid" => $row['courseId'],
                    "description" => $row['description'],
                    "timeCreated" => $row['timeCreated'],
                    "timelimit" => $row['timeLimit'],
                    "questions" => $questions
                );

                // Return the response as JSON
                http_response_code(200);
                echo json_encode($response);
            } else {
                // If test with given id not found, return error response
                http_response_code(400);
                echo json_encode(array("error" => "Test not found"));
            }
        } else {
            // If query fails, return error response
            http_response_code(500);
            echo json_encode(array("error" => "Query execution failed"));
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        // If testid parameter not provided in URL, return error response
        http_response_code(400);
        echo json_encode(array("error" => "Testid parameter missing in URL"));
    }
} else {
    // If request method is not GET, return error response
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
