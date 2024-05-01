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
$sql = "CREATE TABLE Course (
    CourseId INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    teacherId INT,
    Test INT,
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
$sql = "CREATE TABLE Test (
    testId INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    question TEXT, -- Storing question IDs as JSON array
    timeLimit INT,
    timeCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (testId) REFERENCES Course(Test)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Test created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>

<?php
$sql = "CREATE TABLE Question (
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