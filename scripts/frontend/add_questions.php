<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Smart</title>
    <link rel="icon" href="./src/logo testsmart.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .question-block {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            z-index: 9999;
            width: 80%;
            /* Đặt chiều rộng cho popup */
            max-width: 600px;
            /* Đặt chiều rộng tối đa */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Thêm shadow */
        }

        .popup h2 {
            margin-top: 0;
            /* Loại bỏ margin trên cho tiêu đề */
        }

        .popup input[type="text"],
        .popup select {
            width: calc(100% - 20px);
            /* Đặt chiều rộng cho các input và select */
            margin-bottom: 10px;
            /* Thêm khoảng cách giữa các input và select */
            padding: 8px;
            /* Thêm padding */
            border: 1px solid #ccc;
            /* Thêm border */
            border-radius: 4px;
            /* Thêm viền cong */
        }

        .popup button {
            padding: 8px 16px;
            /* Thêm padding cho nút */
            border: none;
            /* Loại bỏ border */
            background-color: #007bff;
            /* Màu nền cho nút */
            color: white;
            /* Màu chữ cho nút */
            border-radius: 4px;
            /* Thêm viền cong */
            cursor: pointer;
            /* Thêm icon con trỏ */
            transition: background-color 0.3s;
            /* Hiệu ứng chuyển đổi màu nền */
        }

        .popup button:hover {
            background-color: #0056b3;
            /* Màu nền hover */
        }

        .popup button:not(:last-child) {
            margin-right: 10px;
            /* Thêm khoảng cách giữa các nút */
        }

        .popup .form-group {
            margin-bottom: 20px;
            /* Thêm khoảng cách giữa các form group */
        }

        #save-questions-btn {
            padding: 8px 12px;
            /* Adjust padding to make the button smaller */
            font-size: 14px;
            /* Adjust font size to make the button text smaller */
        }
    </style>
    <script <?php
    session_start();
    if (isset($_SESSION['teacherid'])) {
        echo 'teacherid="' . $_SESSION['teacherid'] . '"';
    } else {
        echo 'teacherid="-1"';
    }
    if (isset($_SESSION['teachername'])) {
        echo ' teachername="' . $_SESSION['teachername'] . '"';
    }
    ?>></script>
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
                <div class="content-block shadow">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Add Test</h1>
                                <div class="mb-3">
                                    <label for="testname" class="form-label">Test Name</label>
                                    <input type="text" class="form-control" id="testname" name="testname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="timelimit" class="form-label">Time Limit</label>
                                    <input type="number" class="form-control" id="timelimit" name="timelimit" required>
                                </div>
                                <button id="add-question-btn" class="btn btn-primary">Add Question</button>
                                <button type="button" id="save-questions-btn" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content block for viewing added questions -->
                <div class="content-block shadow">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>View Questions</h1>
                                <div id="question-container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popup window for adding a new question -->
                <div id="popup" class="popup">
                    <h2>Add New Question</h2>
                    <form id="add-question-form">
                        <div class="mb-3">
                            <label for="question-popup" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question-popup" name="question-popup" required>
                        </div>
                        <div class="mb-3">
                            <label for="optionA-popup" class="form-label">Option A</label>
                            <input type="text" class="form-control" id="optionA-popup" name="optionA-popup" required>
                        </div>
                        <div class="mb-3">
                            <label for="optionB-popup" class="form-label">Option B</label>
                            <input type="text" class="form-control" id="optionB-popup" name="optionB-popup" required>
                        </div>
                        <div class="mb-3">
                            <label for="optionC-popup" class="form-label">Option C</label>
                            <input type="text" class="form-control" id="optionC-popup" name="optionC-popup" required>
                        </div>
                        <div class="mb-3">
                            <label for="optionD-popup" class="form-label">Option D</label>
                            <input type="text" class="form-control" id="optionD-popup" name="optionD-popup" required>
                        </div>
                        <div class="mb-3">
                            <label for="answer-popup" class="form-label">Answer</label>
                            <select class="form-select" id="answer-popup" name="answer-popup" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="difficulty-popup" class="form-label">Difficulty Level</label>
                            <select class="form-select" id="difficulty-popup" name="difficulty-popup" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>

                    </form>
                    <button id="close-popup-btn" class="btn btn-secondary">Close</button>
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function () {
                        // Show popup for adding a new question
                        $("#add-question-btn").click(function () {
                            $("#popup").show();
                        });

                        // Close the popup
                        $("#close-popup-btn").click(function () {
                            $("#popup").hide();
                        });

                        // Submit form to add a new question
                        $("#add-questions-form").submit(function (event) {
                            event.preventDefault();
                            // Code to submit the form data via AJAX and handle response
                        });

                        // Submit form inside popup to add a new question
                        $("#add-question-form").submit(function (event) {
                            event.preventDefault();
                            // Code to submit the form data via AJAX and handle response
                            // After successful response, add the question to the question container
                            var questionHtml = "<div class='question-block'>" +
                                "<p>Question: " + $("#question-popup").val() + "</p>" +
                                "<p>Options: " + $("#optionA-popup").val() + ", " + $("#optionB-popup").val() + ", " + $("#optionC-popup").val() + ", " + $("#optionD-popup").val() + "</p>" +
                                "<p>Answer: " + $("#answer-popup").val() + "</p>" +
                                "<p>Difficulty: " + $("#difficulty-popup").val() + "</p>" +
                                "</div>";
                            $("#question-container").append(questionHtml);
                            $("#popup").hide();
                        });
                    });
                </script>

                <script>
                    $("#save-questions-btn").click(function () {
                        var questions = []; // Mảng để lưu các câu hỏi

                        // Lặp qua mỗi câu hỏi đã thêm
                        $(".question-block").each(function () {
                            console.log($(this).find("#question-popup"))
                            var question = {
                                question: $(this).find("#question-popup").val(),
                                optionA: $(this).find("#optionA-popup").val(),
                                optionB: $(this).find("#optionB-popup").val(),
                                optionC: $(this).find("#optionC-popup").val(),
                                optionD: $(this).find("#optionD-popup").val(),
                                answer: $(this).find("#answer-popup").val(),
                                difficulty: $(this).find("#difficulty-popup").val()
                            };

                            questions.push(question); // Thêm câu hỏi vào mảng
                        });

                        // Get courseId from URL parameters
                        var urlParams = new URLSearchParams(window.location.search);
                        console.log(urlParams);
                        var courseId = urlParams.get('courseId');

                        // Get testname, description, and timelimit from user input
                        var testname = $("#testname").val();
                        var description = $("#description").val();
                        var timelimit = $("#timelimit").val();

                        console.log(courseId);
                        console.log(testname);
                        console.log(description);
                        console.log(timelimit);
                        console.log(questions);

                        // Send data via AJAX request
                        $.ajax({
                            url: "../backend/test/createTest.php",
                            method: "POST",
                            data: {
                                auth_key: "your_valid_auth_key",
                                courseid: courseId,
                                testname: testname,
                                description: description,
                                timelimit: timelimit,
                                question: JSON.stringify(questions) // Convert questions array to JSON string
                            },
                            success: function (response) {
                                // Handle response from server
                                if (response.success) {
                                    alert("Test created successfully."); // Display success message
                                    window.location.href = "test list.php"; // Redirect to test_list.php
                                } else {
                                    alert("Failed to create test. Please try again."); // Display error message
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText); // Handle error if any
                                alert("Failed to create test. Please try again."); // Display error message
                            }
                        });
                    });

                </script>
            </div>
        </div>
    </div>
</body>