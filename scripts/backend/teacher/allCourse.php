<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the required parameter 'teacherid' is set in the URL
    if (isset($_GET['teacherid'])) {
        // Extract the teacherid from the URL
        $teacherid = $_GET['teacherid'];

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

        // Prepare SQL query to fetch courses information based on teacherid
        $sql = "SELECT courseId, name AS coursename, description, timeCreated FROM Course WHERE teacherId = $teacherid";

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // If query successful, fetch data
            $courses = array();
            while ($row = mysqli_fetch_assoc($result)) {
                // Fetch the tests associated with each course
                $course_tests = array();
                $sql_tests = "SELECT testId FROM Test WHERE courseId = " . $row['courseId'];
                $result_tests = mysqli_query($conn, $sql_tests);

                while ($test_row = mysqli_fetch_assoc($result_tests)) {
                    $course_tests[] = $test_row['testId'];
                }

                // Construct the course object
                $course = array(
                    "coursename" => $row['coursename'],
                    "description" => $row['description'],
                    "timeCreated" => $row['timeCreated'],
                    "test" => $course_tests
                );

                // Add the course object to the courses array
                $courses[] = $course;
            }

            // Construct the response
            $response = array(
                "courses" => $courses
            );

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
        // If teacherid parameter not provided in URL, return error response
        http_response_code(400);
        echo json_encode(array("error" => "Teacherid parameter missing in URL"));
    }
} else {
    // If request method is not GET, return error response
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
