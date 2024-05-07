<?php
include '../../db-create/db-config.php';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$resultsPerPage = 4; // Number of results per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page, default to 1
$offset = max(0, ($page - 1) * $resultsPerPage); // Calculate offset

// Construct the base SQL query
$query = "SELECT c.*, t.name AS teacher_name 
          FROM course c 
          LEFT JOIN teacher t ON c.teacherId = t.teacherId";

// Add search filter if applicable
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE c.name LIKE '%$searchTerm%' OR t.name LIKE '%$searchTerm%'";
}

// Add LIMIT clause for pagination
$query .= " LIMIT $offset, $resultsPerPage";

// Execute the query to get search results
$result = mysqli_query($conn, $query);

// Get total number of pages
$totalPagesQuery = "SELECT CEIL(COUNT(*) / $resultsPerPage) AS totalPages FROM course";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $totalPagesQuery .= " WHERE name LIKE '%$searchTerm%' OR teacher_name LIKE '%$searchTerm%'";
}
$totalPagesResult = mysqli_query($conn, $totalPagesQuery);
$totalPagesRow = mysqli_fetch_assoc($totalPagesResult);

// error_log($totalPagesRow['totalPages']);
$totalPages = $totalPagesRow['totalPages'];

// Prepare array to store search results
$searchResults = [];

// Loop through each course to fetch test count
while ($row = mysqli_fetch_assoc($result)) {
    // Get test count for the current course
    $sql_get_test = "SELECT COUNT(*) AS test_count FROM test WHERE courseId = " . $row['courseId'];
    $result_test = mysqli_query($conn, $sql_get_test);
    $row_test = mysqli_fetch_assoc($result_test);
    
    // Add test count to the course details
    $row['test_count'] = $row_test['test_count'];
    
    // Add course details to search results array
    $searchResults[] = $row;
}

// Prepare response data
$response = [
    'results' => $searchResults,
    'totalPages' => $totalPages
];

// Return the response as JSON
echo json_encode($response);

mysqli_close($conn);
?>
