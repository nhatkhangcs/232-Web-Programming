function handle_dropdown() {
    //HANDLE DROPDOWN SECTION
// document.addEventListener('DOMContentLoaded', function () {
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

// });



var editCourse = document.getElementsByClassName('course-form-edit-button');
for (var i = 0; i < editCourse.length; i++) {
    editCourse[i].addEventListener('click', function () {
        // Call the existing onclick function, if any
        if (this.onclick) {
        }
        // Call the new function
        showEditForm(this);
    });
}
function showEditForm(button) {
    var edit_course = document.getElementById('editCoursePopup');
    edit_course.style.display = "block";

    const edit_course_btn = document.querySelectorAll('.course-form-edit-button');
    edit_course_btn.forEach(menu => {
        menu.classList.remove('show');
    });

}
}

const teacherId = parseInt(document.currentScript.getAttribute('teacherid'));
const teacherName = document.currentScript.getAttribute('teachername');

let updateId = -1;

function fetchCourse() {
    // let teacherId = parseInt(document.currentScript.getAttribute('teacherid'));
    // let teacherName = document.currentScript.getAttribute('teachername');
    $.ajax({
        type: 'GET',
        url: `../backend/teacher/allCourse.php?teacherid=${teacherId}&auth_key=your_valid_auth_key`,
        dataType: 'json',
        success: function(data) {
            console.log("ajax data",data);
            let courses = data.courses;
            let courseHtml = '';
            $.each(courses, function(index, course) {
                console.log(course.test);
                let length = course.test.length;
                courseHtml += `
                <div class="course-item shadow" onclick="location.href='test list.php?courseId=${course.courseId}';">
                    <div class="course-item-title">${course.coursename}
                        <div class="course-item-option">
                            <i class="material-icons fs-5">more_horiz</i>
                            <div class="course-item-dropdown">
                                <button onclick="setUpdateId(${course.courseId})" name="edit-course" class="course-item-dropdown-option course-form-edit-button">
                                    <i class="material-icons fs-5 me-2">edit</i>edit
                                </button>
                                <div> 
                                    <input type="hidden" name="delete_course" value="${course.courseId}">
                                    <button onclick="handleDeleteCourse(${course.courseId})" class="course-item-dropdown-option">
                                        <i class="material-icons fs-5 me-2">delete</i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item-creator">
                        <img src="../src/avatar.png" class="creator-image shadow">
                        Created by <content class="course-item-author">${teacherName}</content>
                    </div>
                    <div class="course-item-total">
                        Total Test: <content>${length}</content>
                    </div>
                    <div class="course-item-description">${course.description}</div>
                    <div class="course-item-update-time">
                        <i class="material-icons fs-6 mx-1">update</i>${course.timeCreated}
                    </div>
                </div>`;
        });
        $('#course-block-list').html(courseHtml);
        handle_dropdown();
        },
    });

                
}
fetchCourse();

function handleAddCourse() {
    // $('#add-course-form').submit(function(e) {
    //     e.preventDefault();
        let courseName = $('#courseName').val();
        let courseDescription = $('#courseDescription').val();
        // let teacherId = parseInt(document.currentScript.getAttribute('teacherid'));
        let auth_key = 'your_valid_auth_key';
        if (courseName == '' || courseDescription == '') {
            alert('Please fill in all fields');
            return;
        }
        $.ajax({
            type: 'POST',
            url: `../backend/teacher/createCourse.php`,
            data: {
                coursename: courseName,
                description: courseDescription,
                teacherid: teacherId,
                auth_key: auth_key
            },
            success: function(data) {
                console.log(data);
                fetchCourse();

                $('#add-course-form').hide();
            }
        });
    // });
}

function handleDeleteCourse(courseId) {
    console.log(courseId);
    let auth_key = 'your_valid_auth_key';
    if (confirm('Are you sure you want to delete this course?')) {
        $.ajax({
            type: 'DELETE',
            url: `../backend/teacher/deleteCourse.php?courseid=${courseId}&auth_key=${auth_key}`,

            success: function(data) {
                console.log(data);
                fetchCourse();
            }
        });
    }
}

function setUpdateId(id) {
    updateId = id;
    console.log(updateId);
}

function handleEditCourse() {
    if (updateId === -1) {
        alert('Something went wrong. Please try again later');
        return;
    }
    let courseName = $('#editCourseName').val();
    let courseDescription = $('#editCourseDescription').val();
    console.log(courseName, courseDescription);
    let auth_key = 'your_valid_auth_key';
    if (courseName == '' || courseDescription == '') {
        $('#editCoursePopup').hide();
        return;
    }
    $.ajax({
        type: 'PUT',
        url: `../backend/teacher/updateCourse.php?courseid=${updateId}&auth_key=${auth_key}`,
        data: {
            courseid: updateId,
            auth_key: auth_key,
            update_attribute: {
                name: courseName,
                description: courseDescription
            },
        },
        success: function(data) {
            console.log(data);
            fetchCourse();
            $('#editCourseName').val('');
            $('#editCourseDescription').val('');
            $('#editCoursePopup').hide();
        }
    });
}

function handleCancelEditCourse() {
    $('#editCoursePopup').hide();
}