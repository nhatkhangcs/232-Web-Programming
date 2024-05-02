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
                    <i class="material-icons dashboard-item-icon fs-2">school</i>
                    My course
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
                    <div class="tool-bar-course-name">
                        <i class="material-icons">arrow_back_ios</i></button>
                        <content>Math midterm exam</content>
                    </div>

                    <!-- Share type -->
                    <div class="tool-bar-share-type">
                        <i class="material-icons me-2">group</i></button>
                        Public
                    </div>

                    <!-- search-bar -->
                    <div class="search-bar">
                        <input type="text" name="search" placeholder="Search here" class="search-item">
                        <button type="submit" class="search-button">
                            <i class="material-icons">search</i></button>
                    </div>

                    <!-- Filter -->
                    <div class="filter-bar tool-bar-filter">
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

                    <!-- Add course -->
                    <button class="add-test-button">+ Add test</button>
                    <div class="d-flex me-3">
                        <i class="material-icons">more_horiz</i></button>
                    </div>

                </div>

                <!-- course description -->
                <div class="course-description">
                    <content>Description:</content> <br>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                    anim id est laborum.

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
                                        <i class="material-icons ms-2" style="color: #737373;">more_vert</i>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add course form -->
        <div class="add-course-form shadow">
            <div class="add-course-form-content">
                <!-- form title -->
                <div class="add-course-form-title">
                    Add a course
                    <div><i class="material-icons fs-3 mx-1">close</i></div>
                </div>
                <!-- form input -->
                <form action="">
                    <!-- Enter course name -->
                    <div class="add-course-form-option">
                        <label for="courseName" class="form-label">Course name</label>
                        <input type="text" id="courseName" name="courseName" placeholder="Enter course name"
                            class="form-control">
                    </div>
                    <!-- Choose sharing type -->
                    <div class="add-course-form-option">
                        <label for="courseShare" class="form-label">Share</label>
                        <select id="courseShare" name="courseShare" class="form-select">
                            <option value="Private" class="form-control">Private</option>
                            <option value="Public" class="form-control">Public</option>
                        </select>
                    </div>
                    <!-- Enter description -->
                    <div class="add-course-form-option">
                        <label for="courseDescription" class="form-label">Description</label>
                        <textarea id="courseDescription" name="courseDescription" placeholder="Enter course description"
                            class="form-control"></textarea>
                    </div>

                    <!-- Form button -->
                    <div class="add-course-form-button">
                        <button class="add-course-form-button-cancel">Cancel</button>
                        <button class="add-course-form-button-summit">Add course</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>