<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
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

    // Check if the required parameters are set in the URL
    if (isset($_GET['takentestid']) && isset($_GET['review'])) {
        // Extract the parameters from the URL
        $takentestid = $_GET['takentestid'];
        $review = $_GET['review'];

        // Establishing the database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            http_response_code(500);
            echo json_encode(array("error" => "Database connection failed"));
            exit();
        }

        // Prepare SQL query to fetch taken test overview
        $sql = "SELECT COUNT(*) AS totalquestion, SUM(chosen = answer) AS rightanswer, timeTaken, testId FROM TakenQuestion INNER JOIN TakenTest ON TakenQuestion.takenTestId = TakenTest.takenTestId WHERE TakenTest.takenTestId = $takentestid GROUP BY TakenTest.takenTestId";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalquestion = $row['totalquestion'];
            $rightanswer = $row['rightanswer'];
            $time_taken = $row['timeTaken'];
            $testId = $row['testId'];

            // Fetch additional information from the Test and Course tables
            $sql_test = "SELECT testname, courseId FROM Test WHERE testId = $testId";
            $result_test = mysqli_query($conn, $sql_test);
            if (mysqli_num_rows($result_test) > 0) {
                $row_test = mysqli_fetch_assoc($result_test);
                $test_name = $row_test['testname'];
                $courseId = $row_test['courseId'];

                $sql_course = "SELECT coursename FROM Course WHERE courseId = $courseId";
                $result_course = mysqli_query($conn, $sql_course);
                if (mysqli_num_rows($result_course) > 0) {
                    $row_course = mysqli_fetch_assoc($result_course);
                    $course_name = $row_course['coursename'];

                    // Close database connection
                    mysqli_close($conn);

                    // Return response
                    http_response_code(200);
                    echo json_encode(array(
                        "totalquestion" => $totalquestion,
                        "rightanswer" => $rightanswer,
                        "time_taken" => $time_taken,
                        "test_name" => $test_name,
                        "testid" => $testId,
                        "course_name" => $course_name,
                        "courseid" => $courseId
                    ));
                } else {
                    mysqli_close($conn);
                    http_response_code(400);
                    echo json_encode(array("error" => "Failed to fetch course information"));
                }
            } else {
                mysqli_close($conn);
                http_response_code(400);
                echo json_encode(array("error" => "Failed to fetch test information"));
            }
        } else {
            mysqli_close($conn);
            http_response_code(400);
            echo json_encode(array("error" => "No data found for the specified taken test"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing takentestid or review parameter in URL"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
