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
    <script src="do_test_pagejs.js"
    <?php
    session_start();
    if (isset($_SESSION['studentid'])) {
        echo 'studentid=' . $_SESSION['studentid'];
    }
    else {
        echo 'studentid=-1';
    }
    ?>
    ></script>
</head>

<body>
    <div class="main-content">
        <div class="header-bar shadow-sm mb-0">

        <!-- header title -->
            <div class="header-title">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mt-3">
                    <li class="breadcrumb-item"><a id="courseName" href="#">Course</a></li>
                    <li id="testName" class="breadcrumb-item active" aria-current="page">Test</li>
                  </ol>
                </nav>
            </div>
            <!-- User avatar -->
            <div class="user-avatar">
                <?php
                    include './component/user.php';
                ?>
            </div>
        </div>
    </div>
    <div class="page-container">

        <!-- main-content -->
        <div class="main-content">
            <!-- header bar -->
            

            <!-- page content -->
            <div class="">
                <div id="questions"></div>
            </div>
            
        </div>
        <div class="card mt-2 do_test_overview shadow-sm mx-2" style="height: fit-content">
            <div class="card-header bg-body d-flex justify-content-center">
                <p id="time-left" class="fw-bold me-1 mb-0">Time left:</p>
            </div>
            <div class="card-body">
                <div id="question_box_container">No question found!</div>
            </div>
            <div class="card-footer bg-body mb-3 d-flex justify-content-center">
            <!-- <input type="checkbox" onclick="changeColor(1)"> Check 1<br>
            <input type="checkbox" onclick="changeColor(2)"> Check 2<br> -->
                <button class="btn btn-outline-primary me-3" style="border-radius: 12px;" onclick="handleCancel()">
                    <p class="button_content-2 mb-0 mx-1 fw-bold">Cancel</p>
                </button>
                <button class="btn btn-primary" style="border-radius: 12px;" onclick="handleSubmission()">
                    <p class="button_content mb-0 mx-1 fw-bold">Submit</p>
                </button>
            </div>

        </div>
    </div>
</body>

</html>