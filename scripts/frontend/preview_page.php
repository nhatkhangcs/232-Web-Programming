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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="preview_pagejs.js"></script>
    <?php
    session_start();
    ?>
</head>

<body>
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
                            <div class="col ps-3">
                                <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb mb-0 mt-2">
                                    <li class="breadcrumb-item"><a id="courseNameNav" href="#">Course</a></li>
                                    <li id="testNameNav" class="breadcrumb-item active" aria-current="page">Test</li>
                                  </ol>
                                </nav>
                            </div>
                            <div class="view-mode col">
                                <i class="material-icons dashboard-item-icon-2 fs-4">visibility</i>
                                Preview
                            </div>
                            <div class="col text-sm-end">
                                <?php
                                    if (isset($_SESSION['teacherid'])) {
                                        echo '<button class="btn btn-primary mt-1" onclick="exportToDOCX()"> 
                                        <div class="button_content">
                                        <i class="material-icons btn-item-icon fs-5 me-1">ios_share</i> Export
                                        </div>
                                    </button>';
                                }
                                ?>
                                <!-- <button class="btn btn-primary mt-1" onclick="exportToPDF()"> 
                                    <div class="button_content">
                                    <i class="material-icons btn-item-icon fs-5 me-1">play_circle</i> Do test
                                    </div>
                                </button> -->
                                <button class="btn btn-primary mt-1" onclick="window.location.href='do_test_page.php?testid=1'"> 
                                    <div class="button_content">
                                    <i class="material-icons btn-item-icon fs-5 me-1">play_circle</i> Do test
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="export-content">
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
                            <div id="questions"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>