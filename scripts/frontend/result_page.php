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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="result_pagejs.js"></script>
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
                    <i class="material-icons dashboard-item-icon fs-2">travel_explore</i>
                    Explore
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
            <div class="content-block shadow" style="height: fit-content;">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col ps-3">
                                <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb mb-0 mt-1">
                                    <li class="breadcrumb-item"><a id="courseNameNav" href="#">Course</a></li>
                                    <li id="testNameNav" class="breadcrumb-item active" aria-current="page">Test</li>
                                  </ol>
                                </nav>
                            </div>
                            <div class="view-mode col">
                                <p class="fw-bold result-color mb-1">Result</p>
                            </div>
                            <div class="col text-sm-end">
                                <button id="review_page_btn" class="btn btn-outline-primary" onclick="window.location.href='#'"> 
                                    <div class="button_content-2">
                                    <i class="material-icons fs-5 me-1">visibility</i> Review
                                    </div>
                                </button>
                                <button id="do_test_btn" class="btn btn-primary" onclick="window.location.href='#'"> 
                                    <div class="button_content">
                                    <i class="material-icons btn-item-icon fs-5 me-1">play_circle</i> Do again
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container text-center">
                            <p class="fw-bold fs-3 mb-2" id="courseName">Sample course name</p>
                            <p class="fw-bold me-1 d-inline fs-5">Test:</p><p class="d-inline fs-5" id="testName">Test</p>
                        </div>
                        <div class="container ps-5 d-flex mb-5 px-0">
                            <canvas id="doughnutChart" width="400" height="400"></canvas>
                            <div class="result_param mx-auto">
                                <div class="fs-5">
                                    <p class="fw-bold me-1 mb-2">Total point:</p><p id="totalPoint">Not available</p>
                                </div>
                                <div class="fs-5">
                                    <p class="fw-bold me-1 mb-2">Correct answer:</p><p id="correctAns">Not available</p>
                                </div>
                                <div class="fs-5">
                                    <p class="fw-bold me-1 mb-2">Completion time:</p><p id="timeTaken">Not available</p>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>