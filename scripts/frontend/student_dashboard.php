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
    <div class="page-container">
        <!-- sidebar -->
        <div class="sidebar shadow">
            <!-- dashboard logo -->
            <div class="logo-sidebar">
                <img src="../src/logo.png" width="120px">
            </div>

            <!-- dashboard -->
            <div class="dashboard-item" onclick="window.location.href='dashboard.html'">
                <i class="material-icons dashboard-item-icon fs-2">space_dashboard</i>
                Dashboard
            </div>

            <!-- course -->
            <div class="dashboard-item" onclick="window.location.href='my course.html'">
                <i class="material-icons dashboard-item-icon fs-2">school</i>
                My course
            </div>

            <!-- explore -->
            <div class="dashboard-item">
                <i class="material-icons dashboard-item-icon fs-2">travel_explore</i>
                Explore
            </div>

            <!-- history -->
            <div class="dashboard-item">
                <i class="material-icons dashboard-item-icon-2 fs-2">history</i>
                History
            </div>

            <!-- account -->
            <div class="dashboard-item">
                <i class="material-icons dashboard-item-icon-2 fs-2">person</i>
                Account
            </div>

            <!-- log out -->
            <div class="dashboard-item">
                <i class="material-icons dashboard-item-icon-2 fs-2">logout</i>
                Log out
            </div>

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
                    <img src="../src/avatar.png" class="avatar-image shadow">
                    <div class="user-avatar-text">
                        <div class="user-avatar-name">Nathaniel</div>
                        <div class="user-avatar-role">Teacher</div>
                    </div>
                </div>
            </div>

            <!-- page content -->
            <div class="content-block shadow"></div>
        </div>
    </div>
</body>

</html>