const courseid = parseInt(document.currentScript.getAttribute('courseid'));
console.log(courseid);

function handleDropdown() {
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
        // btn.addEventListener('click', function () {
        //     modal.style.display = "block";
        // });

        // // When the user clicks on the close icon (x), close the modal
        // span.addEventListener('click', function () {
        //     modal.style.display = "none";
        // });

        // // When the user clicks on cancel button, close the modal
        // cancelButton.addEventListener('click', function () {
        //     modal.style.display = "none";
        // });

        // Clicking outside the form should close the form
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    // });

}

function showTestList() {
    let auth_key = 'your_valid_auth_key'
    $.ajax({
        type: 'GET',
        url: `../backend/test/getTestInfo.php?courseid=${courseid}&auth_key=${auth_key}`,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            let testList = data.tests;
            console.log(testList);
            if (testList.length > 0) {
                // Clear existing test list
                $('#test-list-body').empty();

                // Iterate over test data and append rows to the table
                testList.forEach(function(test) {
                    let html = `
                        <tr class="list-item">
                            <td>
                                <div class="d-flex .align-item-center">
                                    <i class="material-icons me-2" style="color: #4D5FFF;">description</i>
                                    ${test.description}
                                </div>
                            </td>
                            <td>${test.timeCreated}</td>
                            <td>${test.questions.length}</td>
                            <td>${test.timelimit} minutes</td>
                            <td>
                                <div class="text-start">
                                    <div class="course-item-option justify-content-center">
                                        <i class="material-icons fs-5 ">more_vert</i>
                                        <div class="course-item-dropdown">
                                            <button type="submit" name="delete_btn" class="course-item-dropdown-option"><i class="material-icons fs-5 me-2">edit</i>edit</button>
                                            <div> 
                                                <input type="hidden" name="delete_course" value="${test.testid}">
                                                <button onclick="handleDeleteTest(${test.testid})" class="course-item-dropdown-option"><i class="material-icons fs-5 me-2">delete</i>Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    $('#test-list-body').append(html);
                    handleDropdown();
                });
            } else {
                $('#test-list-body').html('<tr><td colspan="5">No test found.</td></tr>');
            }

        },
        error: function (data) {
            console.log(data);
        }
    });

}
showTestList();

function handleDeleteTest(testid) {
    let auth_key = 'your_valid_auth_key'
    console.log(testid);
    if (!confirm('Are you sure you want to delete this test?')) {
        return;
    }
    $.ajax({
        type: 'DELETE',
        url: `../backend/test/deleteTest.php?testid=${testid}&auth_key=${auth_key}`,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            showTestList();
        },
        error: function (data) {
            console.log("error",data);
        }
    });
}