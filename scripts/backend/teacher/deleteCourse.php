<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is DELETE
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
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

        // Prepare SQL query to delete the course from the database
        $sql = "DELETE FROM Course WHERE CourseId = $courseid";

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            http_response_code(200);
            echo json_encode(array("success" => "Course deleted successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Something went wrong. Please try again later."));
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing courseid parameter"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
