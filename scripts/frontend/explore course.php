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
                <div class="">
                    <!-- Course block list -->
                    <div class="course-block" id="courseBlock"></div>
                    <!-- Pagination -->
                    <!-- <div class="pagination-container" id="paginationContainer"></div> -->
                    <!-- course-item -->
                    <script>
                        // Call the PHP file to get search results
                        fetch('./component/course_results.php<?php echo isset($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?><?php echo isset($_GET['page']) ? '&page=' . $_GET['page'] : '' ?>')
                            .then(response => response.json())
                            .then(data => {
                                console.log('DATA',data);
                                const courseBlock = document.getElementById('courseBlock');
                                //console.log(courseBlock);
                                const paginationContainer = document.getElementById('paginationContainer');
                                //console.log(paginationContainer);

                                if (data.results.length > 0) {
                                    // Display search results
                                    data.results.forEach(course => {
                                        console.log(course);
                                        courseBlock.innerHTML += `
                                <div class="course-item shadow" onclick="location.href=\'explore test.php?courseId=${course.courseId}\';">
                                    <div class="course-item-title-explore">${course.name}</div>
                                    <div class="course-item-creator">
                                        <img src="../src/avatar.png" class="creator-image shadow">
                                        Create by <content class="course-item-author">${course.teacher_name}</content>
                                    </div>
                                    <div class="course-item-total">Total Test: <content>${course.test_count}</content></div>
                                    <div class="course-item-description">${course.description}</div>
                                    <div class="course-item-update-time">
                                        <i class="material-icons fs-6 mx-1">update</i> ${course.timeCreated}
                                    </div>
                                </div>
                            `;
                                    });

                                    
                                    // Display pagination controls
                                    if (data.totalPages > 1) {
                                        const ul = document.createElement('ul');
                                        ul.classList.add('pagination', 'justify-content-center', 'mt-3');

                                        for (let i = 1; i <= data.totalPages; i++) {
                                            const li = document.createElement('li');
                                            li.classList.add('page-item');

                                            const a = document.createElement('a');
                                            a.classList.add('page-link');
                                            a.href = `?search=${encodeURIComponent('<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>')}&page=${i}`;
                                            a.textContent = i;

                                            li.appendChild(a);
                                            ul.appendChild(li);
                                        }

                                        paginationContainer.appendChild(ul);
                                    }
                                } else {
                                    courseBlock.innerHTML = 'No courses found.';
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    </script>

                </div>
                <div class="pagination-container" id="paginationContainer"></div>
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