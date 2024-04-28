function createBoxes(num) {
    var container = document.getElementById("question_box_container");
    console.log(container);
    container.innerHTML = ""; // Clear existing content
    for (var i = 1; i <= num; i++) {
        var box = document.createElement("div");
        box.className = "box";
        box.innerHTML = i;
        container.appendChild(box);
    }
}

// Function to change color of a box when checkbox is checked
function changeColor(index) {
    console.log("Radio button selected");
    var boxes = document.getElementsByClassName("box");
    var currentBox = boxes[index];
    if (!currentBox.classList.contains("checked")) {
        currentBox.classList.add("checked");
    }
}

function startTimer(testId, countdownIntervalMinutes) {
    // Calculate the target date and time
    const targetDate = new Date();
    targetDate.setMinutes(targetDate.getMinutes() + countdownIntervalMinutes);

    // Store the target time in local storage with a key that includes the test ID
    localStorage.setItem(`targetTime_${testId}`, targetDate.getTime());

    // Update the countdown every second
    const countdownInterval = setInterval(function() {
        // Get the current date and time
        const now = new Date().getTime();
        
        // Get the stored target time from local storage based on the test ID
        const storedTargetTime = localStorage.getItem(`targetTime_${testId}`);

        // Calculate the time remaining
        const timeRemaining = storedTargetTime - now;
        
        // Check if the countdown is over
        if (timeRemaining <= 0) {
            clearInterval(countdownInterval);
            document.getElementById('time-left').textContent = 'Time Over';
            localStorage.removeItem(`targetTime_${testId}`);
        } else {
            // Calculate minutes and seconds
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            
            // Update the countdown display
            document.getElementById('time-left').textContent = `Time left: ${minutes}:${seconds}`;
        }
    }, 1000); // Update every second
}

function handleSubmission() {
    // Get the test ID
    const testId = 1; // Replace '1' with the actual test ID
    localStorage.removeItem(`targetTime_${testId}`);
    const previewUrl = `result_page.php?takentestid=${testId}`;
    window.location.href = previewUrl;
};

$(document).ready(function() {
    // Make AJAX request to get test data
    $.ajax({
        type: 'GET',
        url: './sampledata/tests.php',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            // Display test information
            $('#testName').text(data.testname);
            $('#testDescription').text(data.description);
            $('#testDuration').text(data.timelimit);

            $.ajax({
                type: 'GET',
                url: './sampledata/questions.php',
                dataType: 'json', // Specify the expected data type
                success: function(questionsData) {
                    // Display total questions count
                    const questionsLength = questionsData.questions.length;
                    $('#totalQuestions').text(questionsLength);
                    console.log(questionsData);
                    createBoxes(questionsLength);
                    
                    // Create HTML for questions
                    let questionsHtml = '';
                    $.each(questionsData.questions, function(index, question) {
                        questionsHtml += `
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="fw-bold me-1 mb-0 d-inline">Question ${index + 1}:</p><div class="question d-inline">${question.question}</div>
                                    <div class="container ms-0 options">
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="changeColor(${index})">
                                        <p class="fw-bold me-1 mb-0 d-inline">A.</p><div class="optionA d-inline">${question.optionA}</div><br>
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="changeColor(${index})">
                                        <p class="fw-bold me-1 mb-0 d-inline">B.</p><div class="optionB d-inline">${question.optionB}</div><br>
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="changeColor(${index})">
                                        <p class="fw-bold me-1 mb-0 d-inline">C.</p><div class="optionC d-inline">${question.optionC}</div><br>
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="changeColor(${index})">
                                        <p class="fw-bold me-1 mb-0 d-inline">D.</p><div class="optionD d-inline">${question.optionD}</div><br>
                                    </div>
                                </div>
                            </div>
                        `;
                        // var radios = document.getElementsByName(`Radio-question-${index + 1}`);
                        // console.log(radios);

                        // // Add onchange event listener to each radio button
                        // $.each(radios, function(index, radio) {
                        //     radio.onclick = function() {
                        //         // Your code to handle the radio button click
                        //         console.log("Radio button selected");
                        //     };
                        // });
                    });
                    $('#questions').html(questionsHtml);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching questions data:', error);
                }
            });
            // Set the countdown interval (in minutes)
            const testId = 1; 
            const defaultCountdownInterval = 45;

            const storedTargetTime = localStorage.getItem(`targetTime_${testId}`);
            if (storedTargetTime) {
                // Calculate the time remaining based on the stored target time
                const timeRemaining = storedTargetTime - new Date().getTime();

                // Start the countdown timer for the specific test regardless of whether there is time remaining or not
                startTimer(testId, Math.floor(timeRemaining / (1000 * 60))); // Convert milliseconds to minutes
            } else {
                // If there is no stored target time, start the countdown timer for the specific test with the default interval
                startTimer(testId, defaultCountdownInterval); // Replace 'defaultCountdownInterval' with your default interval value
            }

        },
        error: function(xhr, status, error) {
            console.error('Error fetching test data:', error);
        }
    });
});