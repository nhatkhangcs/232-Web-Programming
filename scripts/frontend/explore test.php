<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Smart</title>
    <link rel="icon" href="../src/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="page-container">
        <!-- sidebar -->
        <div class="sidebar shadow">
            <!-- dashboard logo -->
            <div class="logo-sidebar" onclick="window.location.href='index.php?page=home-page'">
                <img src="./src/logo testsmart.png" width="120px">
            </div>

            <!-- dashboard -->
            <div class="dashboard-item" onclick="window.location.href='index.php?page=dashboard'">
                <i class="material-icons dashboard-item-icon fs-2">space_dashboard</i>
                Dashboard
            </div>

            <!-- course -->
            <div class="dashboard-item" onclick="window.location.href='index.php?page=my-course'">
                <i class="material-icons dashboard-item-icon fs-2">school</i>
                My course
            </div>

            <!-- explore -->
            <div class="dashboard-item" onclick="window.location.href='index.php?page=explore-course'">
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
                    <i class="material-icons dashboard-item-icon fs-2">travel_explore</i>
                    Explore
                </div>

                <div class="user-avatar">
                    <img src="../src/avatar.png" class="avatar-image shadow">
                    <div class="user-avatar-text">
                        <div class="user-avatar-name">Nathaniel</div>
                        <div class="user-avatar-role">Teacher</div>
                    </div>
                </div>
            </div>

            <!-- page content -->
            <div class="content-block shadow">
                <!-- Tool bar -->
                <div class="tool-bar">
                    <!-- course name -->
                    <div class="tool-bar-course-name" onclick="window.location.href='index.php?page=explore-course'">
                        <i class="material-icons">arrow_back_ios</i></button>
                        <?php
                        include ('database.php');
                        $query = "SELECT * FROM course WHERE CourseId = 1";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<content>' . htmlspecialchars($row['name']) . '</content>';
                            }
                        } else {
                            echo 'ERROR';
                        }
                        mysqli_close($conn);
                        ?>
                    </div>

                    <!-- search-bar -->
                    <div class="search-bar">
                        <input type="text" name="search" placeholder="Search here" class="search-item">
                        <button type="submit" class="search-button">
                            <i class="material-icons">search</i></button>
                    </div>

                    <!-- Filter -->
                    <div class="">
                        <div class="filter-section">Create time:<div class="filter-value"></div>
                            <!-- dropdown option -->
                            <div class="filter-dropdown">
                                <div class="dropdown-option" data-value="All">All</div>
                                <div class="dropdown-option" data-value="Today">Today</div>
                                <div class="dropdown-option" data-value="Less than 3 days">Less than 3 days</div>
                                <div class="dropdown-option" data-value="Less than 1 week">Less than 1 week</div>
                                <div class="dropdown-option" data-value="Less than 1 month">Less than 1 month</div>
                                <div class="dropdown-option" data-value="Less than 3 months">Less than 3 months</div>
                                <div class="dropdown-option" data-value="Less than 6 months">Less than 6 months</div>
                                <div class="dropdown-option" data-value="Less than 1 year">Less than 1 year</div>
                                <div class="dropdown-option" data-value="Less than 1 year">More than 1 year</div>
                            </div>

                            <i class="material-icons">expand_more</i></button>
                        </div>
                    </div>

                    <!-- Creator name -->
                    <div class="course-item-creator">
                        Create by:
                        <img src="../src/avatar.png" class="creator-image shadow ms-2">
                        <content class="course-item-author">
                            <?php
                            include ('database.php');
                            $query = "SELECT * FROM teacher WHERE TeacherId = 1";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '' . htmlspecialchars($row['name']) . '';
                                }
                            } else {
                                echo 'ERROR';
                            }
                            mysqli_close($conn);
                            ?>
                        </content>
                    </div>
                </div>

                <!-- course description -->
                <div class="course-description">
                    <content>Description:</content> <br>
                    <?php
                    include ('database.php');
                    $query = "SELECT * FROM course WHERE CourseId = 1";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '' . htmlspecialchars($row['description']) . '';
                        }
                    } else {
                        echo 'ERROR';
                    }
                    mysqli_close($conn);
                    ?>

                </div>

                <!-- list table -->
                <div class="list-table-container">
                    <table class="list-table">
                        <thead>
                            <tr>
                                <th class="text-start">Name</th>
                                <th>Create time</th>
                                <th>Question</th>
                                <th>Duaration</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- List item -->
                            <tr class="list-item">
                                <td>
                                    <div class="d-flex .align-item-center">
                                        <i class="material-icons me-2" style="color: #4D5FFF;">description</i>
                                        Midterm exam 2021
                                    </div>
                                </td>
                                <td>15 Apr 2024</td>
                                <td>40</td>
                                <td>45 minutes</td>
                                <td>
                                    <div class="text-end">
                                        <i class="material-icons fs-3 me-3" style="color: #4D5FFF;">play_circle</i>
                                    </div>
                                </td>
                            </tr>


                            <?php
                            include 'database.php';

                            $query = "SELECT * FROM test WHERE courseId = 1";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr class="list-item">
                                    <td>
                                        <div class="d-flex .align-item-center">
                                            <i class="material-icons me-2" style="color: #4D5FFF;">description</i>'
                                        . htmlspecialchars($row['description']) .
                                        '</div>
                                    </td>
                                    <td>' . htmlspecialchars($row['timeCreated']) . '</td>
                                    <td>' . htmlspecialchars($row['question']) . '</td>
                                    <td>' . htmlspecialchars($row['timeLimit']) . '</td>
                                    <td>
                                    <div class="text-end">
                                        <i class="material-icons fs-3 me-3" style="color: #4D5FFF;">play_circle</i>
                                    </div>
                                    </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo 'No test found.';
                            }

                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>