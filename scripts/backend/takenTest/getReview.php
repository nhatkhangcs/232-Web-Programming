<?php
// Database connection settings
include '../../db-create/db-config.php';

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

        // Prepare SQL query to fetch taken test review
        $sql = "SELECT Test.testname AS test_name, Test.testId AS testid, Course.coursename AS course_name, Course.courseId AS courseid, TakenTest.timeTaken, Test.timeLimit FROM TakenTest INNER JOIN Test ON TakenTest.testId = Test.testId INNER JOIN Course ON Test.courseId = Course.courseId WHERE TakenTest.takenTestId = $takentestid";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $test_name = $row['test_name'];
            $testid = $row['testid'];
            $course_name = $row['course_name'];
            $courseid = $row['courseid'];
            $time_taken = $row['timeTaken'];
            $timelimit = $row['timeLimit'];

            // Fetch taken questions
            $sql_questions = "SELECT TakenQuestion.chosenOption, Question.* FROM TakenQuestion INNER JOIN Question ON TakenQuestion.questionId = Question.questionId WHERE TakenQuestion.takenTestId = $takentestid";
            $result_questions = mysqli_query($conn, $sql_questions);
            $taken_questions = array();
            while ($row_question = mysqli_fetch_assoc($result_questions)) {
                $taken_questions[] = $row_question;
            }

            // Close database connection
            mysqli_close($conn);

            // Return response
            http_response_code(200);
            echo json_encode(array(
                "test_name" => $test_name,
                "testid" => $testid,
                "course_name" => $course_name,
                "courseid" => $courseid,
                "time_taken" => $time_taken,
                "timelimit" => $timelimit,
                "taken_questions" => $taken_questions
            ));
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
