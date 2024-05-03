$(document).ready(function() {
    // Make AJAX request to get test data
    var testId = new URLSearchParams(window.location.search).get('testId');
    testId = 1;
    $.ajax({
        type: 'GET',
        url: '../backend/test/getTest.php?testid=' + testId + '&auth_key=your_valid_auth_key',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            console.log(data);
            // Display test information
            $('#testNameNav').text(data.testname);
            $('#testName').text(data.testname);
            $('#testDescription').text(data.description);
            $('#testDuration').text(data.timelimit + ' minutes');

            $.ajax({
                type: 'GET',
                url: '../backend/question/getQuestion.php?testid=' + testId + '&answer=true&auth_key=your_valid_auth_key',
                dataType: 'json', // Specify the expected data type
                success: function(questionsData) {
                    // Display total questions count
                    const questionsLength = questionsData.questions.length;
                    $('#totalQuestions').text(questionsLength);
                    console.log(questionsData);
                    
                    // Create HTML for questions
                    let questionsHtml = '';
                    $.each(questionsData.questions, function(index, question) {
                        questionsHtml += `
                            <p class="fw-bold me-1 mb-0 d-inline">Question ${index + 1}:</p><div class="question d-inline">${question.question}</div>
                            <div class="container options">
                                <p class="fw-bold me-1 mb-0 d-inline">A.</p><div class="optionA d-inline">${question.optionA}</div><br>
                                <p class="fw-bold me-1 mb-0 d-inline">B.</p><div class="optionB d-inline">${question.optionB}</div><br>
                                <p class="fw-bold me-1 mb-0 d-inline">C.</p><div class="optionC d-inline">${question.optionC}</div><br>
                                <p class="fw-bold me-1 mb-0 d-inline">D.</p><div class="optionD d-inline">${question.optionD}</div><br>
                            </div>
                        `;
                    });
                    $('#questions').html(questionsHtml);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching questions data:', error);
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching test data:', error);
        }
    });
});