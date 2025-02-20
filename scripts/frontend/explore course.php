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
                    Explore course
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
                        <input type="text" name="search" placeholder="Search course name or teacher name"
                            class="search-explore-course">
                        <button type="submit" class="search-button">
                            <i class="material-icons">search</i></button>
                    </div>

                    <!-- Filter -->
                    <div class="filter-bar">
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
                </div>
                <!-- Course block list -->
                <div class="course-block ">
                    <!-- course-item -->
                    <?php
                    include '../db-create/db-config.php';

                    $conn = mysqli_connect($host, $username, $password, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }


                    $query = "SELECT * FROM course";
                    $result = mysqli_query($conn, $query);

                    // $query2 = "SELECT * FROM teacher";
                    // $result2 = mysqli_query($conn, $query2);
                    // $row2 = mysqli_fetch_assoc($result2);
                    // var_dump($row2);


                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $query2 = "SELECT * FROM teacher WHERE teacherId = " . $row['teacherId'];
                            $result2 = mysqli_query($conn, $query2);
                            $row2 = mysqli_fetch_assoc($result2);

                            $sql_get_test = "SELECT COUNT(*) AS test_count FROM test WHERE courseId = " . $row['courseId'];
                            $result_test = mysqli_query($conn, $sql_get_test);
                            $row_test = mysqli_fetch_assoc($result_test);

                            echo '<div class="course-item shadow" onclick="location.href=\'explore test.php?courseId=' . $row['courseId'] . '\';">';
                            echo '<div class="course-item-title-explore">';
                            echo htmlspecialchars($row['name']);
                            echo '</div>';
                            echo '<div class="course-item-creator"><img src="../src/avatar.png" class="creator-image shadow">
                                    Create by <content class="course-item-author">' . htmlspecialchars($row2['name']) . '</content>
                                </div>';
                            echo '<div class="course-item-total">
                                    Total Test: <content>' . $row_test['test_count'] . '</content>';
                            echo '</div>';
                            echo '<div class="course-item-description">' . htmlspecialchars($row['description']) . '</div>';
                            echo '<div class="course-item-update-time">
                                    <i class="material-icons fs-6 mx-1">update</i>'
                                . htmlspecialchars($row['timeCreated']) .
                                '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No courses found.';
                    }

                    mysqli_close($conn);
                    ?>

                </div>
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

                // Set default filter value to 'All' based on the filter
                if (!filterValue.textContent.trim()) {
                    const defaultOption = dropdown.querySelector('.dropdown-option[data-value="All"]');
                    filterValue.textContent = defaultOption ? defaultOption.textContent : 'All';
                }
            });

            // Setup dropdown functionality
            function setupDropdown(triggerElement, dropdown, filterValue = null) {
                triggerElement.addEventListener('click', function (event) {
                    event.stopPropagation(); // Stop propagation to allow for outside clicks to close dropdown
                    // Toggle current dropdown
                    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';

                    // Close other dropdowns
                    const allDropdowns = document.querySelectorAll('.filter-dropdown');
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
                const allDropdowns = document.querySelectorAll('.filter-dropdown');
                allDropdowns.forEach(function (dropdown) {
                    dropdown.style.display = 'none';
                });
            });
        });
    </script>
</body>

</html>