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
    <script src="review_pagejs.js"></script>
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
                    <i class="material-icons dashboard-item-icon fs-2">travel_explore</i>
                    Explore
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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col ps-3 mt-2">
                                <a class="result-color text-decoration-none fw-bold" href="result_page.php?takentestid=<?php echo $_GET['takentestid']; ?>"> 
                                    <div class="review-question result-color">
                                        <i class="material-icons">arrow_back_ios</i>
                                        Result

                                    </div> 
                                </a>
                            </div>
                            <div class="view-mode col">
                                <i class="material-icons dashboard-item-icon-2 fs-4">visibility</i>
                                Review
                            </div>
                            <div class="col text-sm-end">
                                <!-- <button class="btn btn-primary mt-1" onclick="window.location.href='do_test_page.php?testid=1'"> 
                                    <div class="button_content">
                                    <i class="material-icons btn-item-icon fs-5 me-1">ios_share</i> Export
                                    </div>
                                </button> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container text-center">
                            <p class="fw-bold fs-3 mb-2" id="courseName">Sample course name</p>
                            <p class="fw-bold me-1 d-inline fs-5">Test:</p><p class="d-inline fs-5" id="testName">Test</p>
                            <div class="d-flex justify-content-evenly mx-5 mt-2 mb-2">
                                <div>
                                    <p class="fw-bold me-1">Time:</p><p id="testDuration">Duration</p>
                                </div>
                                <div>
                                    <p class="fw-bold me-1">Total questions:</p><p id="totalQuestions">100</p>
                                </div>
                                <div>
                                    <p class="fw-bold me-1">Total point:</p><p id="totalPoint">10</p>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div id="taken_questions"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>