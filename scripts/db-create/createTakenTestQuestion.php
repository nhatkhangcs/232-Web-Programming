<?php
include 'db-config.php';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
$sql = "CREATE TABLE IF NOT EXISTS TakenTest (
    takenTestId INT AUTO_INCREMENT PRIMARY KEY,
    testId INT,
    dateTaken TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    studentId INT,
    timeTaken INT,
    FOREIGN KEY (testId) REFERENCES Test(testId),
    FOREIGN KEY (studentId) REFERENCES Student(studentId)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table TakenTest created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

<?php
$sql = "CREATE TABLE IF NOT EXISTS TakenQuestion (
    takenQuestionId INT AUTO_INCREMENT PRIMARY KEY,
    questionId INT,
    takenTestId INT,
    chosenOption VARCHAR(255),
    FOREIGN KEY (questionId) REFERENCES Question(questionId),
    FOREIGN KEY (takenTestId) REFERENCES TakenTest(takenTestId)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table TakenQuestion created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>
