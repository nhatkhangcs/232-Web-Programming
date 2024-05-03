<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameters are set in the request body
    if (isset($_POST['auth_key']) && isset($_POST['courseid']) && isset($_POST['testname']) && isset($_POST['description']) && isset($_POST['timelimit']) && isset($_POST['question'])) {
        // Extract the parameters from the request body
        $auth_key = $_POST['auth_key'];
        $courseid = $_POST['courseid'];
        $testname = $_POST['testname'];
        $description = $_POST['description'];
        $timelimit = $_POST['timelimit'];
        $questions = json_decode($_POST['question'], true);

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

        // Start transaction
        mysqli_autocommit($conn, false);

        // Prepare SQL query to insert new test into the database
        $sql_test = "INSERT INTO Test (courseId, name, description, timeLimit) VALUES ($courseid, '$testname', '$description', $timelimit)";

        // Execute SQL query to insert new test
        if (mysqli_query($conn, $sql_test)) {
            // Get the auto-generated testId
            $testId = mysqli_insert_id($conn);

            // Prepare SQL query to insert new questions into the database
            $sql_questions = "INSERT INTO Question (testId, image, question, optionA, optionB, optionC, optionD, answer, difficultyLevel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql_questions);
            mysqli_stmt_bind_param($stmt, "issssssss", $testId, $image, $question, $optionA, $optionB, $optionC, $optionD, $answer, $difficulty);

            foreach ($questions as $q) {
                $image = $q['image'];
                $question = $q['question'];
                $optionA = $q['optionA'];
                $optionB = $q['optionB'];
                $optionC = $q['optionC'];
                $optionD = $q['optionD'];
                $answer = $q['answer'];
                $difficulty = $q['difficulty'];

                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
            }

            // Commit transaction
            mysqli_commit($conn);

            http_response_code(200);
            echo json_encode(array("success" => "Test created successfully"));
        } else {
            // Rollback transaction
            mysqli_rollback($conn);

            http_response_code(500);
            echo json_encode(array("error" => "Something went wrong. Please try again later."));
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close database connection
        mysqli_close($conn);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing parameters"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
