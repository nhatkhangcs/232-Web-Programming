// function exportToPDF() {
//     var element = document.getElementById('export-content');

//     var opt = {
//         margin: 0.5,
//         filename: 'export.pdf',
//         image: { type: 'jpeg', quality: 0.98 },
//         html2canvas: { scale: 2 },
//         jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
//     };

//     html2pdf().set(opt).from(element).save();
// }

function exportToDOCX() {
    var element = document.getElementById('export-content');

    // Make AJAX request to get test data
    var testId = new URLSearchParams(window.location.search).get('testid');
    $.ajax({
        type: 'GET',
        url: '../backend/test/getTest.php?testid=' + testId + '&auth_key=your_valid_auth_key',
        dataType: 'json',
        success: function(data) {
            // Store test data
            var testData = {
                testName: data.testname,
                courseName: data.coursename,
                testDescription: data.description,
                testDuration: data.timelimit,
                questions: []
            };

            // Make AJAX request to get questions data
            $.ajax({
                type: 'GET',
                url: '../backend/question/getQuestion.php?testid=' + testId + '&answer=true&auth_key=your_valid_auth_key',
                dataType: 'json',
                success: function(questionsData) {
                    // Process questions data
                    $.each(questionsData.questions, function(index, question) {
                        // Construct HTML for question options
                        var optionsArray = [question.optionA, question.optionB, question.optionC, question.optionD];

                        // Append question data to testData
                        testData.questions.push({
                            questionText: question.question,
                            image: question.image,
                            options: optionsArray
                        });
                    });

                    // Now testData contains all required information
                    // Make AJAX request to export data to DOCX
                    $.ajax({
                        type: 'POST',
                        url: 'exportToDOCX.php',
                        data: JSON.stringify(testData), // Send test data to PHP script
                        contentType: 'application/json',
                        success: function(response) {
                            // Handle success response (if needed)
                            console.log('Exported to DOCX:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error exporting to DOCX:', error);
                        }
                    });
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
}


$(document).ready(function() {
    // Make AJAX request to get test data
    var testId = new URLSearchParams(window.location.search).get('testid');
    $.ajax({
        type: 'GET',
        url: '../backend/test/getTest.php?testid=' + testId + '&auth_key=your_valid_auth_key',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            console.log(data);
            // Display test information
            $('#testNameNav').text(data.testname);
            $('#testName').text(data.testname);
            $('#courseName').text(data.coursename);
            $('#courseNameNav').text(data.coursename);
            $('#courseNameNav').attr('href', 'explore test.php?courseId=' + data.courseid);
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
                        let imageHtml = '';
                        if (question.image !== "") {
                            imageHtml = `<br><image class="mb-1" src="../image/test/${question.image}" alt="Question Image" class="img-fluid" style="max-width: 450px;">`;
                        }
                        questionsHtml += `
                            <p class="fw-bold me-1 mb-0 d-inline">Question ${index + 1}:</p><div class="question d-inline">${question.question}</div>
                            ${imageHtml}
                            <div class="container options mb-2">
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