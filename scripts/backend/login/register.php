<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameters are set in the POST body
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
        // Extract the parameters from the POST body
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Establishing the database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            http_response_code(500);
            echo json_encode(array("error" => "Database connection failed"));
            exit();
        }

        // Perform user registration
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            // Registration successful
            http_response_code(200);
            echo json_encode(array("success" => "User registered successfully"));
        } else {
            // Registration failed
            http_response_code(500);
            echo json_encode(array("error" => "User registration failed"));
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing username, password, or role in POST body"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid request method"));
}
?>
