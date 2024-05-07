<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection settings
    include '../db-create/db-config.php';

    try {
        // Establishing the database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Setting PDO to throw exceptions for error handling
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Check if the login is as a teacher, student, or admin
        if ($role === 'teacher') {
            // Validate teacher credentials
            $stmt = $pdo->prepare("SELECT * FROM Teacher WHERE username = :username");
        } elseif ($role === 'student') {
            // Validate student credentials
            $stmt = $pdo->prepare("SELECT * FROM Student WHERE username = :username");
        } elseif ($role === 'admin') {
            // Validate admin credentials (assuming there's an admin table)
            $stmt = $pdo->prepare("SELECT * FROM Admin WHERE username = :username");
        } else {
            // Invalid role, redirect back to login page with error message
            header("Location: ../frontend/login.php?error=InvalidRole");
            exit();
        }

        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // User authentication successful, redirect to respective dashboard
                if ($role === 'teacher') {
                    session_start();
                    $_SESSION['role'] = 'teacher';
                    $_SESSION['teacherid'] = $user['teacherId'];
                    $_SESSION['teachername'] = $user['name'];
                    header("Location: ../frontend/teacher_dashboard.php");
                } elseif ($role === 'student') {
                    session_start();
                    $_SESSION['role'] = 'student';
                    $_SESSION['studentid'] = $user['studentId'];
                    $_SESSION['studentname'] = $user['name'];
                    // header("Location: ../frontend/do_test_page.php");
                    header("Location: ../frontend/student_dashboard.php");
                } elseif ($role === 'admin') {
                    session_start();
                    $_SESSION['role'] = 'admin';
                    $_SESSION['adminid'] = $user['adminId'];
                    header("Location: ../frontend/admin_dashboard.php");
                }
                exit();
            } else {
                // User authentication failed, redirect back to login page with error message
                header("Location: ../frontend/login_page.php?error=invalid");
                exit();
            }
        } else {
            // User authentication failed, redirect back to login page with error message
            header("Location: ../frontend/login_page.php?error=invalid");
            exit();
        }
    } catch (PDOException $e) {
        // Catch any database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
