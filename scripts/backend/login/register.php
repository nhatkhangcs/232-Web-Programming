<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required parameters are set in the POST body
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
        // Extract the parameters from the POST body

        // Establishing the database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            http_response_code(500);
            echo json_encode(array("error" => "Database connection failed"));
            exit();
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username is unique within its corresponding table
        $table_name = $role; // Assuming table names are capitalized
        $sql_check_username = "SELECT COUNT(*) as count FROM $table_name WHERE userName = '$username'";
        $result = mysqli_query($conn, $sql_check_username);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            http_response_code(400);
            echo json_encode(array("error" => "Username already exists!"));
            header("Location: ../../frontend/signup_page.php?error=taken");
            exit();
        }

        $sql_check_email = "SELECT COUNT(*) as count FROM $table_name WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_check_email);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            http_response_code(400);
            echo json_encode(array("error" => "Email already exists!"));
            header("Location: ../../frontend/signup_page.php?error=emailtaken");
            exit();
        }

        // Insert the user into the appropriate table based on role
        $sql_insert_user = "INSERT INTO $table_name (username, password, name, email) VALUES ('$username', '$hashed_password', '$username', '$email')";
        if (mysqli_query($conn, $sql_insert_user)) {
            // Registration successful
            echo json_encode(array("message" => "User registered successfully"));
            header("Location: ../../frontend/login_page.php");
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Registration failed"));
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
