<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // Check if the required parameter 'testid' is set in the request body
    if (isset($_PUT['testid']) && isset($_PUT['update_attribute'])) {
        // Extract the testid and update_attribute from the request body
        $testid = $_PUT['testid'];
        $update_attribute = $_PUT['update_attribute'];

        // Check if the required parameter 'auth_key' is set in the request body
        if (isset($_PUT['auth_key'])) {
            // Extract the auth_key from the request body
            $auth_key = $_PUT['auth_key'];

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

        // Prepare SQL query to update the test based on the provided update_attribute
        switch ($update_attribute) {
            case 'testname':
                // Extract the new testname from the request body
                $new_testname = $_PUT['new_value'];
                $sql = "UPDATE Test SET name = '$new_testname' WHERE testId = $testid";
                break;
            case 'description':
                // Extract the new description from the request body
                $new_description = $_PUT['new_value'];
                $sql = "UPDATE Test SET description = '$new_description' WHERE testId = $testid";
                break;
            case 'timelimit':
                // Extract the new timelimit from the request body
                $new_timelimit = $_PUT['new_value'];
                $sql = "UPDATE Test SET timeLimit = $new_timelimit WHERE testId = $testid";
                break;
            default:
                http_response_code(400);
                echo json_encode(array("error" => "Invalid update_attribute value"));
                exit();
        }

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            http_response_code(200);
            echo json_encode(array("success" => "Test updated successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Something went wrong. Please try again later."));
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing testid or update_attribute parameter"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
