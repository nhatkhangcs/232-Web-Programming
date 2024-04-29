$(document).ready(function() {
    // Make AJAX request to get test data
    $.ajax({
        type: 'GET',
        url: './sampledata/takentests.php?takentestid=1&review=true',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            // Display test information
            console.log(data);
            $('#testName').text(data.testname);
            $('#testDuration').text(data.timelimit);
            const questionsLength = data.taken_questions.length;
            $('#totalQuestions').text(questionsLength);
            $('#testDuration').text(data.timelimit);

            let questionsHtml = '';
            $.each(data.taken_questions, function(index, question) {
                const chosenOption = question.chosen_option;
                const answer = question.answer;
                questionsHtml += `
                    <p class="fw-bold me-1 mb-0 d-inline">Question ${index + 1}:</p><div class="question d-inline">${question.question}</div>
                    <div class="container options">
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'A' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">A.</p><div class="optionA d-inline">${question.optionA}</div>
                            ${chosenOption === 'A'  ? `<i class="material-icons ps-3 me-1 ${answer === 'A' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'B' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">B.</p><div class="optionB d-inline">${question.optionB}</div>
                            ${chosenOption === 'B'  ? `<i class="material-icons ps-3 me-1 ${answer === 'B' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'C' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">C.</p><div class="optionC d-inline">${question.optionC}</div>
                            ${chosenOption === 'C'  ? `<i class="material-icons ps-3 me-1 ${answer === 'C' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'D' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">D.</p><div class="optionD d-inline">${question.optionD}</div>
                            ${chosenOption === 'D'  ? `<i class="material-icons ps-3 me-1 ${answer === 'D' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                    </div>
                `;
            });
            $('#taken_questions').html(questionsHtml);
            
        },
        error: function(xhr, status, error) {
            console.error('Error fetching test data:', error);
        }
    });
});