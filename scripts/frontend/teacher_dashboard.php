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
                <div class="container ps-5 pt-5">
                    <div class="text-primary">
                        <p class="fw-bold fs-1 d-inline text-primary">HELLO </p>

                        <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
                            echo '<p class="fw-bold fs-1 d-inline"> TEACHER</p>';
                            echo '<p class="fw-bold fs-1 d-inline"> ' . $_SESSION['teachername'] . '</p>';
                        
                        }
                        ?>
                    </div>
                    <p class="fw-bold fs-4">Welcome back to Test Smart</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>