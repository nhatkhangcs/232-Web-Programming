<?php
include '../../db-create/db-config.php';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$resultsPerPage = 4; // Number of results per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page, default to 1
$offset = max(0, ($page - 1) * $resultsPerPage); // Calculate offset

file_put_contents('debug.log', $offset);

// Construct the base SQL query with column aliases
// Check if the intermediate table already exists
$tableExistsQuery = "SHOW TABLES LIKE 'intermediate_table'";
$tableExistsResult = mysqli_query($conn, $tableExistsQuery);

if (mysqli_num_rows($tableExistsResult) == 0) {
    // Construct the base SQL query with column aliases
    $query = "SELECT course.courseId AS courseId, course.name AS courseName, course.description AS description, course.timeCreated AS timeCreated, teacher.teacherId AS teacherId, teacher.name AS teacherName
              FROM course
              INNER JOIN teacher ON course.teacherId = teacher.teacherId";

    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Create a new table named "intermediate_table" with additional columns
        $createTableQuery = "CREATE TABLE intermediate_table (
                                courseId INT,
                                courseName VARCHAR(255),
                                description TEXT,
                                timeCreated DATETIME,
                                teacherId INT,
                                teacherName VARCHAR(255)
                            )";

        if (mysqli_query($conn, $createTableQuery)) {
            // Fetch rows from the result set and insert into the intermediate table
            while ($row = mysqli_fetch_assoc($result)) {
                $insertQuery = "INSERT INTO intermediate_table (courseId, courseName, description, timeCreated, teacherId, teacherName) 
                                VALUES ('{$row['courseId']}', '{$row['courseName']}', '{$row['description']}', '{$row['timeCreated']}', '{$row['teacherId']}', '{$row['teacherName']}')";

                mysqli_query($conn, $insertQuery);

                file_put_contents('debug1.log', $insertQuery);
            }

            //echo "Intermediate table created successfully and data inserted.";
        }
    }
}

// } else {
//     echo "Intermediate table already exists.";
// }

// Add search filter if applicable
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);

    // Modify the base query to search in the intermediate table
    $query = "SELECT * FROM intermediate_table WHERE courseId LIKE '%$searchTerm%' OR courseName LIKE '%$searchTerm%' OR teacherId LIKE '%$searchTerm%' OR teacherName LIKE '%$searchTerm%'";
} else {
    // If no search term is provided, select all records from the intermediate table
    $query = "SELECT * FROM intermediate_table";
}

// Add LIMIT clause for pagination
$query .= " LIMIT $offset, $resultsPerPage";

file_put_contents('debug2.log', $query);

// Execute the query to get search results
$result = mysqli_query($conn, $query);


// Fetch the total number of pages
$totalPagesQuery = "SELECT CEIL(COUNT(*) / $resultsPerPage) AS totalPages FROM intermediate_table";

file_put_contents('debug3.log', $totalPagesQuery);
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $totalPagesQuery .= " WHERE courseId LIKE '%$searchTerm%' OR courseName LIKE '%$searchTerm%' OR teacherId LIKE '%$searchTerm%' OR teacherName LIKE '%$searchTerm%'";
}
$totalPagesResult = mysqli_query($conn, $totalPagesQuery);
$totalPagesRow = mysqli_fetch_assoc($totalPagesResult);
$totalPages = $totalPagesRow['totalPages'];


//file_put_contents('debug3.log', $totalPagesResult, FILE_APPEND);
//file_put_contents('debug3.log', $totalPagesRow, FILE_APPEND);
//file_put_contents('debug3.log', $totalPages, FILE_APPEND);

// Prepare array to store search results
$searchResults = [];

// Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Get the test count for the current course
    $sql_get_test = "SELECT COUNT(*) AS test_count FROM test WHERE courseId = " . $row['courseId'];
    $result_test = mysqli_query($conn, $sql_get_test);
    $row_test = mysqli_fetch_assoc($result_test);

    // Add the test count to the course details
    $row['test_count'] = $row_test['test_count'];

    // Add the course details to the search results array
    $searchResults[] = $row;
}

// file_put_contents('debug4.log', $searchResults);

// Prepare the response data
$response = [
    'results' => $searchResults,
    'totalPages' => $totalPages
];

// Return the response as JSON
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>