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
    <script src="my_course.js"
    <?php
    session_start();
    if (isset($_SESSION['teacherid'])) {
        echo 'teacherid="' . $_SESSION['teacherid'] . '"';
    }
    else {
        echo 'teacherid="-1"';
    }
    if (isset($_SESSION['teachername'])) {
        echo ' teachername="' . $_SESSION['teachername'] . '"';
    }
    ?>
    ></script>
</head>

<body>
    <!-- database & backend -->
    <?php
    include '../db-create/db-config.php';

    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // include '../backend/teacher/createCourse.php';
    // include '../backend/teacher/deleteCourse.php';
    // include '../backend/teacher/updateCourse.php';
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
                    <i class="material-icons dashboard-item-icon fs-2">school</i>
                    My course
                </div>

                <div class="user-avatar">
                    <?php
                    include './component/user.php';
                    ?>
                </div>
            </div>

            <!-- page content -->
            <div class="content-block shadow">
                <!-- Tool bar -->
                <div class="tool-bar">
                    <!-- search-bar -->
                    <div class="search-bar">
                        <input type="text" name="search" placeholder="Search here" class="search-item">
                        <button type="submit" class="search-button">
                            <i class="material-icons">search</i></button>
                    </div>

                    <!-- Filter -->
                    <div class="filter-bar">
                        <!-- Share -->
                        <!--   -->
                        <!-- Update time -->
                        <div class="filter-section">Update time:<div class="filter-value"></div>
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
                    <button class="add-course-button">+ Add Course</button>

                </div>

                <div class="course-block" id="course-block-list">
                    <!-- Course block list -->
                    <!-- <div class="ms-3" id="course-block-list"></div> -->

                    
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
                    <div>
                        <input type="hidden" name="auth_key" value="your_valid_auth_key" id="your_valid_auth_key">
                        <!-- Enter course name -->
                        <div class="add-course-form-option">
                            <label for="courseName" class="form-label">Course name</label>
                            <input type="text" id="courseName" name="coursename" placeholder="Enter course name"
                                class="form-control" required>
                        </div>
                        <!-- Enter description -->
                        <div class="add-course-form-option">
                            <label for="courseDescription" class="form-label">Description</label>
                            <textarea id="courseDescription" name="description" placeholder="Enter course description"
                                class="form-control"></textarea>
                        </div>

                        <!-- Form button -->
                        <div class="add-course-form-button">
                            <button class="add-course-form-button-cancel">Cancel</button>
                            <button onclick="handleAddCourse()" class="add-course-form-button-summit">Add course</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit course form -->
            <div class="edit-course-form shadow" id="editCoursePopup">
                <div class="add-course-form-content">
                    <!-- form title -->
                    <div class="add-course-form-title">
                        Edit course
                        <div><i class="material-icons fs-3 mx-1">close</i></div>
                    </div>
                    <!-- form input -->
                    <div>
                        <input type="hidden" name="auth_key" value="your_valid_auth_key" id="your_valid_auth_key">
                        <input type="hidden" id="courseId" name="courseId">
                        <!-- Enter course name -->
                        <div class="add-course-form-option">
                            <label for="courseName" class="form-label">Course name</label>
                            <input type="text" id="editCourseName" name="coursename" placeholder="Enter course name"
                                class="form-control">
                        </div>
                        <!-- Enter description -->
                        <div class="add-course-form-option">
                            <label for="courseDescription" class="form-label">Description</label>
                            <textarea id="editCourseDescription" name="description" placeholder="Enter course description"
                                class="form-control"></textarea>
                        </div>

                        <!-- Form button -->
                        <div class="add-course-form-button">
                            <button onclick="handleCancelEditCourse()" class="edit-course-form-button-cancel">Cancel</button>
                            <button onclick="handleEditCourse()" type="summit" class="add-course-form-button-summit">Save course</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- <script src="my_course_dropdown.js"></script> -->

        <!-- <script>
            //HANDLE DROPDOWN SECTION
            document.addEventListener('DOMContentLoaded', function () {
                // Handle filter dropdowns
                const filterSections = document.querySelectorAll('.filter-section');
                filterSections.forEach(function (filterSection) {
                    const dropdown = filterSection.querySelector('.filter-dropdown');
                    const filterValue = filterSection.querySelector('.filter-value');
                    setupDropdown(filterSection, dropdown, filterValue);

                    // Set default filter value to 'All' or 'All time' based on the filter
                    if (!filterValue.textContent.trim()) {
                        const defaultOption = dropdown.querySelector('.dropdown-option[data-value="All"]');
                        filterValue.textContent = defaultOption ? defaultOption.textContent : 'All';
                    }
                });

                // Handle course item option dropdowns
                const courseOptions = document.querySelectorAll('.course-item-option');
                courseOptions.forEach(function (option) {
                    const dropdown = option.querySelector('.course-item-dropdown');
                    setupDropdown(option, dropdown);
                });

                // Setup dropdown functionality
                function setupDropdown(triggerElement, dropdown, filterValue = null) {
                    triggerElement.addEventListener('click', function (event) {
                        event.stopPropagation(); // Stop propagation to allow for outside clicks to close dropdown
                        // Toggle current dropdown
                        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';

                        // Close other dropdowns
                        const allDropdowns = document.querySelectorAll('.filter-dropdown, .course-item-dropdown');
                        allDropdowns.forEach(function (otherDropdown) {
                            if (otherDropdown !== dropdown) {
                                otherDropdown.style.display = 'none';
                            }
                        });
                    });

                    // For filter dropdowns, update the displayed value
                    if (filterValue) {
                        dropdown.querySelectorAll('.dropdown-option').forEach(function (item) {
                            item.addEventListener('click', function (event) {
                                event.stopPropagation(); // Prevent the click from propagating to the document
                                filterValue.textContent = this.textContent;
                                dropdown.style.display = 'none'; // Close dropdown after selection
                            });
                        });
                    }
                }

                // Clicking outside any dropdown should close all dropdowns
                document.addEventListener('click', function () {
                    const allDropdowns = document.querySelectorAll('.filter-dropdown, .course-item-dropdown');
                    allDropdowns.forEach(function (dropdown) {
                        dropdown.style.display = 'none';
                    });
                });

                // Get the modal
                var modal = document.querySelector('.add-course-form');

                // Get the button that opens the modal
                var btn = document.querySelector('.add-course-button');

                // Get the element that closes the modal
                var span = document.querySelector('.add-course-form-title i');
                var cancelButton = document.querySelector('.add-course-form-button-cancel');

                // When the user clicks the button, open the modal 
                btn.addEventListener('click', function () {
                    modal.style.display = "block";
                });

                // When the user clicks on the close icon (x), close the modal
                span.addEventListener('click', function () {
                    modal.style.display = "none";
                });

                // When the user clicks on cancel button, close the modal
                cancelButton.addEventListener('click', function () {
                    modal.style.display = "none";
                });

                // Clicking outside the form should close the form
                window.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });

            });



            var editCourse = document.getElementsByClassName('course-form-edit-button');
            for (var i = 0; i < editCourse.length; i++) {
                editCourse[i].onclick = function () {
                    showEditForm(this);
                }
            }
            function showEditForm(button) {
                var edit_course = document.getElementById('editCoursePopup');
                edit_course.style.display = "block";

                const edit_course_btn = document.querySelectorAll('.course-form-edit-button');
                edit_course_btn.forEach(menu => {
                    menu.classList.remove('show');
                });

            }

        </script> -->
</body>

</html>
