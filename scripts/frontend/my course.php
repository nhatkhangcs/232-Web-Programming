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
                    <!-- search-bar -->
                    <div class="search-bar">
                        <input type="text" name="search" placeholder="Search here" class="search-item">
                        <button type="submit" class="search-button">
                            <i class="material-icons">search</i></button>
                    </div>

                    <!-- Filter -->
                    <div class="filter-bar">
                        <!-- Share -->
                        <div class="filter-section">Share:<div class="filter-value"></div>
                            <!-- dropdown option -->
                            <div class="filter-dropdown">
                                <div class="dropdown-option" data-value="All">All</div>
                                <div class="dropdown-option" data-value="Private">Private</div>
                                <div class="dropdown-option" data-value="Public">Public</div>
                            </div>

                            <i class="material-icons">expand_more</i></button>
                        </div>
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
                <!-- Course block list -->
                <div class="course-block">
                    <!-- course-item -->
                    <div class="course-item shadow">
                        <!-- title -->
                        <div class="course-item-title">
                            Course Title
                            <i class="material-icons fs-5 course-item-share">lock</i>
                            <div class="course-item-option">
                                <i class="material-icons fs-5 ">more_horiz</i>
                                <!-- Dropdown menu for Edit/Delete options -->
                                <div class="course-item-dropdown">
                                    <div class="course-item-dropdown-option" data-action="edit">
                                        <i class="material-icons fs-5 me-2">edit</i>
                                        Edit
                                    </div>
                                    <div class="course-item-dropdown-option" style="color: red;" data-action="delete">
                                        <i class="material-icons fs-5 me-2">delete</i>
                                        Delete
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- creator -->
                        <div class="course-item-creator"><img src="../src/avatar.png" class="creator-image shadow">
                            Create by <content class="course-item-author">Nathaniel</content>
                        </div>
                        <!-- total course -->
                        <div class="course-item-total">Total Course: <content>0</content>
                        </div>
                        <!-- description -->
                        <div class="course-item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore</div>
                        <!-- update time -->
                        <div class="course-item-update-time">
                            <i class="material-icons fs-6 mx-1">update</i>
                            Update 2 hours Apr 2, 2024 9:30 pm
                        </div>
                    </div>

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

                    // For filter dropdowns, update the displayed value
                    if (filterValue) {
                        dropdown.querySelectorAll('.dropdown-option').forEach(function (item) {
                            item.addEventListener('click', function () {
                                filterValue.textContent = this.textContent;
                                dropdown.style.display = 'none'; // Close dropdown after selection
                            });
                        });
                    }
                });
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