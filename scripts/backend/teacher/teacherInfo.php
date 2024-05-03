<?php
// Database connection settings
include '../../db-create/db-config.php';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the required parameter 'teacherid' is set in the URL
    if (isset($_GET['teacherid'])) {
        // Extract the teacherid from the URL
        $teacherid = $_GET['teacherid'];

        // Establishing the database connection
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            // If connection fails, return error response
            http_response_code(500);
            echo json_encode(array("error" => "Database connection failed"));
            exit();
        }

        // Prepare SQL query to fetch teacher information based on teacherid
        $sql = "SELECT name, email, profileImage FROM Teacher WHERE teacherid = $teacherid";

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // If query successful, fetch data
            $row = mysqli_fetch_assoc($result);

            // Check if teacher with given id exists
            if ($row) {
                // Fetch the courses owned by the teacher
                $sql_courses = "SELECT courseId FROM Course WHERE teacherId = $teacherid";
                $result_courses = mysqli_query($conn, $sql_courses);

                $courses = array();
                while ($course_row = mysqli_fetch_assoc($result_courses)) {
                    $courses[] = $course_row['courseId'];
                }

                // Construct the response
                $response = array(
                    "name" => $row['name'],
                    "email" => $row['email'],
                    "profileImage" => $row['profileImage'],
                    "own_course" => $courses
                );

                // Return the response as JSON
                http_response_code(200);
                echo json_encode($response);
            } else {
                // If teacher with given id not found, return error response
                http_response_code(400);
                echo json_encode(array("error" => "Teacher not found"));
            }
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
