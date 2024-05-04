let testData = {
    testid: -1,
    studentid: parseInt(document.currentScript.getAttribute('studentid')),
    time_taken: -1,
    taken_question: {},
};
let chosenOptions = {};
let time_taken = -1;

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
function saveOption(index, option) {
    console.log("Radio button selected");
    var boxes = document.getElementsByClassName("box");
    var currentBox = boxes[index];
    if (!currentBox.classList.contains("checked")) {
        currentBox.classList.add("checked");
    }
    const questionId = `question_${index + 1}`;
    chosenOptions[questionId] = option;
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
            if (localStorage.getItem(`targetTime_${testId}`) === null) {
                return;
            }
            else {
                localStorage.removeItem(`targetTime_${testId}`);
                sendToDB(countdownIntervalMinutes);
            }
        } else {
            // Calculate minutes and seconds
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            
            // Update the countdown display
            if (seconds < 10) {
                document.getElementById('time-left').textContent = `Time left: ${minutes}:0${seconds}`;
                time_taken = countdownIntervalMinutes - minutes;
            } else {
            document.getElementById('time-left').textContent = `Time left: ${minutes}:${seconds}`;
            time_taken = countdownIntervalMinutes - minutes;
            }
        }
    }, 1000); // Update every second
}

function handleSubmission() {
    console.log("Submission button clicked");
    // Get the test ID
    const testId = 1; // Replace '1' with the actual test ID
    localStorage.removeItem(`targetTime_${testId}`);
    sendToDB(time_taken);
};

function sendToDB(timeTaken) {
    // Get the test ID
    testData.time_taken = timeTaken;
    testData.taken_question = chosenOptions;
    console.log(testData);
    $.ajax({
        type: 'POST',
        url: '../backend/takenTest/addTakenTest.php?auth_key=your_valid_auth_key',
        data: JSON.stringify(testData),
        success: function(data) {
            // Display test information
            let jsondata = JSON.parse(data);
            const takentestid = jsondata.takentestid;
            const previewUrl = `result_page.php?takentestid=${takentestid}&review=false`;
            window.location.href = previewUrl;
        },
        error: function(xhr, status, error) {
            console.error('Error sending test data:', error);
        }
    });
    // if (takentestid == -1) {
    //     return;
    // } else {
    //     const previewUrl = `result_page.php?takentestid=${takentestid}&review=false`;
    //     window.location.href = previewUrl;
    // }
};

function handleCancel() {
    // Get the test ID
    const testId = 1; // Replace '1' with the actual test ID
    localStorage.removeItem(`targetTime_${testId}`);
    const previewUrl = `preview_page.php?testid=${testId}`;
    window.location.href = previewUrl;
};

$(document).ready(function() {
    // Make AJAX request to get test data
    var url_string = window.location;
    var url = new URL(url_string);
    var testId = url.searchParams.get("testid");
    var settimelimit = 60;
    testId = 1;
    testData.testid = testId;
    $.ajax({
        type: 'GET',
        url: '../backend/test/getTest.php?testid=' + testId + '&auth_key=your_valid_auth_key',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            // Display test information
            console.log(data);
            $('#courseName').text(data.coursename);
            $('#testName').text(data.testname);
            $('#testDescription').text(data.description);
            $('#testDuration').text(data.timelimit);
            settimelimit = data.timelimit;

            var QtestId = url.searchParams.get("testid");
            QtestId = 1;

            $.ajax({
                type: 'GET',
                url: '../backend/question/getQuestion.php?testid=' + QtestId + '&answer=true&auth_key=your_valid_auth_key',
                dataType: 'json', // Specify the expected data type
                success: function(questionsData) {
                    // Display total questions count
                    const questionsLength = questionsData.questions.length;
                    for (let i = 0; i < questionsLength; i++) {
                        const questionId = `question_${i + 1}`;
                        chosenOptions[questionId] = "";
                    }
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
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="saveOption(${index}, 'optionA')">
                                        <p class="fw-bold me-1 mb-0 d-inline">A.</p><div class="optionA d-inline">${question.optionA}</div><br>
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="saveOption(${index}, 'optionB')">
                                        <p class="fw-bold me-1 mb-0 d-inline">B.</p><div class="optionB d-inline">${question.optionB}</div><br>
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="saveOption(${index}, 'optionC')">
                                        <p class="fw-bold me-1 mb-0 d-inline">C.</p><div class="optionC d-inline">${question.optionC}</div><br>
                                        <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" onchange="saveOption(${index}, 'optionD')">
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
            const defaultCountdownInterval = parseInt(settimelimit);
            console.log(typeof defaultCountdownInterval);

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