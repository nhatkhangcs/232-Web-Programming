$(document).ready(function() {
    // Make AJAX request to get test data
    var takentestid = new URLSearchParams(window.location.search).get('takentestid');
    $.ajax({
        type: 'GET',
        url: '../backend/takenTest/getReview.php?takentestid=' + takentestid + '&review=true&auth_key=your_valid_auth_key',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            // Display test information
            console.log(data);
            $('#testName').text(data.test_name);
            $('#courseName').text(data.course_name);
            $('#testDuration').text(data.timelimit);
            const questionsLength = data.taken_questions.length;
            $('#totalQuestions').text(questionsLength);
            $('#testDuration').text(data.timelimit + ' minutes');

            let questionsHtml = '';
            $.each(data.taken_questions, function(index, question) {
                let imageHtml = '';
                if (question.image !== "") {
                    imageHtml = `<br><image class="mb-1" src="../image/test/${question.image}" alt="Question Image" class="img-fluid" style="max-width: 450px;">`;
                }
                const chosenOption = question.chosenOption;
                const answer = question.answer;
                questionsHtml += `
                    <p class="fw-bold me-1 mb-0 d-inline">Question ${index + 1}:</p><div class="question d-inline">${question.question}</div>
                    ${imageHtml}
                    <div class="container options">
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'optionA' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">A.</p><div class="optionA d-inline">${question.optionA}</div>
                            ${chosenOption === 'optionA'  ? `<i class="material-icons ps-3 me-1 ${answer === 'optionA' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'optionB' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">B.</p><div class="optionB d-inline">${question.optionB}</div>
                            ${chosenOption === 'optionB'  ? `<i class="material-icons ps-3 me-1 ${answer === 'optionB' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'optionC' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">C.</p><div class="optionC d-inline">${question.optionC}</div>
                            ${chosenOption === 'optionC'  ? `<i class="material-icons ps-3 me-1 ${answer === 'optionC' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
                        </div>
                        <div class="review-question">
                            <input class="form-check-input me-1" type="radio" name="Radio-question-${index + 1}" disabled ${chosenOption === 'optionD' ? 'checked' : ''}>
                            <p class="fw-bold me-1 mb-0 d-inline">D.</p><div class="optionD d-inline">${question.optionD}</div>
                            ${chosenOption === 'optionD'  ? `<i class="material-icons ps-3 me-1 ${answer === 'optionD' ? 'text-success">done' : 'text-danger">close'}</i>` : ''}
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