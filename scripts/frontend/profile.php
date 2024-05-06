<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Smart</title>
    <link rel="icon" href="../src/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="page-container">
        <!-- sidebar -->
        <div class="sidebar shadow">
            <!-- dashboard logo -->
            <?php
                include './component/navbar.php';
            ?>

        </div>
        <!-- main-content -->
        <div class="main-content">
            <!-- header bar -->
            <div class="header-bar shadow">

                <!-- header title -->
                <div class="header-title">
                    <i class="material-icons dashboard-item-icon fs-2">space_dashboard</i>
                    Dashboard
                </div>
                <!-- User avatar -->
                <div class="user-avatar">
                    <?php
                        include './component/user.php';
                    ?>
                </div>
            </div>

            <!-- page content -->
            <div class="content-block shadow">
                <div class='card'>
                    <div class='card-header'>
                        <p class='fw-bold mb-0 fs-5'>Profile</p>
                    </div>
                    <div class='card-body mt-3 ms-3'>
                        <?php
                        include '../db-create/db-config.php';

                        $conn = mysqli_connect($host, $username, $password, $dbname);
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 'student') {
                                $sql = "SELECT * FROM student WHERE studentId = '" . $_SESSION['studentid'] . "'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['profileImage'] != null) {
                                            echo "<img src='../image/profile/" . $row['profileImage'] . "' class='avatar-image-big shadow mb-3' alt='Profile Image'>";
                                        }
                                        else {
                                            echo '<img src="../src/avatar.png" class="avatar-image-big shadow mb-3">';
                                        }
                                        echo "<p class='fw-bold'>Username: " . $row['userName'] . "</p>";
                                        echo "<p class='fw-bold'>Name: " . $row['name'] . "</p>";
                                        echo "<p class='fw-bold'>Email: " . $row['email'] . "</p>";
                                    }
                                }
                                echo "<p class='fw-bold fs-4 text-primary mt-5'>Student statistics</p>";

                                $sql_count_taken_test = "SELECT COUNT(*) AS taken_test_count FROM takentest WHERE studentId = '" . $_SESSION['studentid'] . "'";
                                $result_taken_test = $conn->query($sql_count_taken_test);
                                $row_taken_test = $result_taken_test->fetch_assoc();
                                echo "<p>Total tests taken: " . $row_taken_test['taken_test_count'] . "</p>";

                                if ($row_taken_test['taken_test_count'] > 0) {
                                    $sql_get_taken_test = "SELECT * FROM takentest WHERE studentId = '" . $_SESSION['studentid'] . "'";
                                    $result_get_taken_test = $conn->query($sql_get_taken_test);
                                    $total_score = 0;
                                    $average_score = 0;
                                    if ($result_get_taken_test->num_rows > 0) {
                                        while ($row_get_taken_test = $result_get_taken_test->fetch_assoc()) {
                                            $sql_get_result = "SELECT 
                                                                COUNT(*) AS totalquestion, 
                                                                SUM(TakenQuestion.chosenOption = Question.answer) AS rightanswer, 
                                                                TakenTest.timeTaken, 
                                                                TakenTest.testId 
                                                            FROM 
                                                                TakenQuestion 
                                                            INNER JOIN 
                                                                TakenTest ON TakenQuestion.takenTestId = TakenTest.takenTestId 
                                                            INNER JOIN 
                                                                Question ON TakenQuestion.questionId = Question.questionId
                                                            WHERE 
                                                                TakenTest.takenTestId = " . $row_get_taken_test['takenTestId'] . " 
                                                            GROUP BY 
                                                                TakenTest.takenTestId;";
                                            $result_get_result = $conn->query($sql_get_result);
                                            $row_get_result = $result_get_result->fetch_assoc();
                                            $total_score += $row_get_result['rightanswer'] / $row_get_result['totalquestion'] * 100;
                                        }
                                    }
                                    $average_score = $total_score / $row_taken_test['taken_test_count'];
                                    echo "<p>Total score: " . $total_score . "%</p>";
                                    echo "<p>Average score: " . $average_score . "%</p>";
                                }
                                

                            } else if ($_SESSION['role'] == 'teacher') {
                                $sql = "SELECT * FROM teacher WHERE teacherId = '" . $_SESSION['teacherid'] . "'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<p class='fw-bold'>Username: " . $row['userName'] . "</p>";
                                        echo "<p class='fw-bold'>Name: " . $row['name'] . "</p>";
                                        echo "<p class='fw-bold'>Email: " . $row['email'] . "</p>";
                                    }
                                }
                            } else if ($_SESSION['role'] == 'admin') {
                                $sql = "SELECT * FROM admin WHERE adminId = '" . $_SESSION['adminid'] . "'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<p class='fw-bold'>Username: " . $row['userName'] . "</p>";
                                        echo "<p class='fw-bold'>Name: " . $row['name'] . "</p>";
                                    }
                                }
                            }
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>