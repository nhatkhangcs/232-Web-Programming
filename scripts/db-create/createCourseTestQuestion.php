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
$sql = "CREATE TABLE IF NOT EXISTS Course (
    courseId INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    teacherId INT,
    description TEXT,
    timeCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Course created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

<?php
$sql = "CREATE TABLE IF NOT EXISTS Test (
    testId INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    courseId INT,
    description TEXT,
    timeLimit INT,
    timeCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (courseId) REFERENCES Course(courseId)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Test created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

<?php
$sql = "CREATE TABLE IF NOT EXISTS Question (
    questionId INT AUTO_INCREMENT PRIMARY KEY,
    testId INT,
    image VARCHAR(255), -- Assuming image path is stored
    question TEXT,
    optionA VARCHAR(255),
    optionB VARCHAR(255),
    optionC VARCHAR(255),
    optionD VARCHAR(255),
    answer VARCHAR(255),
    difficultyLevel VARCHAR(50),
    FOREIGN KEY (testId) REFERENCES Test(testId)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Question created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>