<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // Check if the required parameters are set in the request body
    parse_str(file_get_contents("php://input"), $_PUT);
    if (isset($_PUT['auth_key']) && isset($_PUT['courseid']) && isset($_PUT['update_attribute'])) {
        // Extract the parameters from the request body
        $auth_key = $_PUT['auth_key'];
        $courseid = $_PUT['courseid'];
        $update_attribute = json_decode($_PUT['update_attribute'], true);

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

        // Prepare SQL query to update the course in the database
        $sql = "UPDATE Course SET ";
        foreach ($update_attribute as $key => $value) {
            $sql .= "$key = '$value', ";
        }
        // Remove trailing comma and space
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE CourseId = $courseid";

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            http_response_code(200);
            echo json_encode(array("success" => "Course updated successfully"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Something went wrong. Please try again later."));
        }

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
