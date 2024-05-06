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
</head>

<body>
    <?php
    include '../db-create/db-config.php';

    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // include 'backend/test/createTest.php';
    // include 'backend/test/deleteTest.php';
    // include 'backend/test/updateTest.php';
    ?>


    <div class="page-container">
        <!-- sidebar -->
        <div class="sidebar shadow">
            <!-- dashboard logo -->
            <div class="logo-sidebar" onclick="window.location.href='index.php?page=home-page'">
                <img src="../src/logo.png" width="120px">
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
                    <div class="tool-bar-course-name" onclick="window.location.href='index.php?page=my-course'">
                        <i class="material-icons">arrow_back_ios</i></button>
                        <?php
                        include '../db-create/db-config.php';

                        $conn = mysqli_connect($host, $username, $password, $dbname);
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
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

                    <!-- Share type -->
                    <!-- <div class="tool-bar-share-type">
                        <i class="material-icons me-2">group</i></button>
                        Public
                    </div> -->

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
                    <?php
                    include '../db-create/db-config.php';

                    $conn = mysqli_connect($host, $username, $password, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
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
                            <?php
                            include '../db-create/db-config.php';

                            $conn = mysqli_connect($host, $username, $password, $dbname);
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

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
                                        <div class="text-start">';
                                    echo '<div class="course-item-option justify-content-center">';
                                    echo '<i class="material-icons fs-5 ">more_vert</i>';
                                    echo '<div class="course-item-dropdown">
                                                <form method = "POST"> 
                                                <input type="hidden" name="course_id" value="ID_OF_THE_COURSE">
                                                <button type="submit" name="delete_btn" class = "course-item-dropdown-option"><i class="material-icons fs-5 me-2">edit</i>edit</button>
                                                </form>
            
                                                <form method = "POST"> 
                                                <input type="hidden" name="delete_course" value="ID_OF_THE_COURSE">
                                                <button type="submit" class = "course-item-dropdown-option"><i class="material-icons fs-5 me-2">delete</i>Delete</button>
                                                </form>
                                            </div>';
                                    echo '</div>';
                                    echo '</div> </td>';
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

    <script>
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



    </script>
</body>

</html>
