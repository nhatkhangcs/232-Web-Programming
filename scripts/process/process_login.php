<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

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

        // Check if the login is as a teacher, student, or admin
        if ($role === 'teacher') {
            // Validate teacher credentials
            $stmt = $pdo->prepare("SELECT * FROM Teacher WHERE username = :username AND password = :password");
        } elseif ($role === 'student') {
            // Validate student credentials
            $stmt = $pdo->prepare("SELECT * FROM Student WHERE username = :username AND password = :password");
        } elseif ($role === 'admin') {
            // Validate admin credentials (assuming there's an admin table)
            $stmt = $pdo->prepare("SELECT * FROM Admin WHERE username = :username AND password = :password");
        } else {
            // Invalid role, redirect back to login page with error message
            header("Location: ../frontend/login.php?error=InvalidRole");
            exit();
        }

        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            // User authentication successful, redirect to respective dashboard
            if ($role === 'teacher') {
                header("Location: ../frontend/teacher_dashboard.php");
            } elseif ($role === 'student') {
                header("Location: ../frontend/student_dashboard.php");
            } elseif ($role === 'admin') {
                header("Location: ../frontend/admin_dashboard.php");
            }
            exit();
        } else {
            // User authentication failed, redirect back to login page with error message
            header("Location: ../frontend/login.php?error=InvalidCredentials");
            exit();
        }
    } catch (PDOException $e) {
        // Catch any database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
