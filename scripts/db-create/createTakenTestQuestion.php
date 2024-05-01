<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is hosted on a different server
$dbname = 'nhatkhang';
$username = 'root'; // Change this to your database username
$password = '872003'; // Change this to your database password

try {
    // Establishing the database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Setting PDO to throw exceptions for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare a SQL statement to create the TakenQuestion table if it doesn't exist
    $createTakenQuestionSQL = "
        CREATE TABLE IF NOT EXISTS TakenQuestion (
            questionId INT AUTO_INCREMENT PRIMARY KEY,
            takenQuestionId INT,
            takenTestId INT,
            chosen BOOLEAN,
            chosenOption VARCHAR(255),
            FOREIGN KEY (takenTestId) REFERENCES TakenTest(TakenTestId)
        )";
    
    // Execute the SQL statement to create TakenQuestion table
    $pdo->exec($createTakenQuestionSQL);
    
    // Prepare a SQL statement to create the TakenTest table if it doesn't exist
    $createTakenTestSQL = "
        CREATE TABLE IF NOT EXISTS TakenTest (
            TakenTestId INT AUTO_INCREMENT PRIMARY KEY,
            dateTaken VARCHAR(14), -- Format: ddmmyyhhmmss
            studentId INT,
            rightAnswer INT,
            timeTaken INT,
            FOREIGN KEY (studentId) REFERENCES Students(studentId)
        )";
    
    // Execute the SQL statement to create TakenTest table
    $pdo->exec($createTakenTestSQL);
    
    echo "Tables 'TakenQuestion' and 'TakenTest' created successfully.";

} catch (PDOException $e) {
    // Catch any database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
<?php
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
$sql = "CREATE TABLE TakenTest (
    testId INT AUTO_INCREMENT PRIMARY KEY,
    dateTaken VARCHAR(14), -- Format: ddmmyyhhmmss
    studentId INT,
    takenQuestion TEXT, -- Storing question IDs as JSON array
    rightAnswer INT,
    timeTaken INT
)";

if (mysqli_query($conn, $sql)) {
    echo "Table TakenTest created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

<?php
$sql = "CREATE TABLE TakenQuestion (
    questionId INT AUTO_INCREMENT PRIMARY KEY,
    testId INT,
    chosen BOOLEAN,
    chosenOption VARCHAR(255),
    FOREIGN KEY (testId) REFERENCES TakenTest(testId)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table TakenQuestion created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>
