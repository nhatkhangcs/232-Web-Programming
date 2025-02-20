$(document).ready(function() {
    // Make AJAX request to get test data
    var takentestid = new URLSearchParams(window.location.search).get('takentestid');
    document.getElementById('review_page_btn').onclick = function() {
        window.location.href = `review_page.php?takentestid=${takentestid}`;
    };
    $.ajax({
        type: 'GET',
        url: '../backend/takenTest/overview.php?takentestid=' + takentestid + '&review=false&auth_key=your_valid_auth_key',
        dataType: 'json', // Specify the expected data type
        success: function(data) {
            // Display test information
            console.log(data);
            $('#testNameNav').text(data.test_name);
            $('#courseNameNav').text(data.course_name);
            $('#courseNameNav').attr('href', 'explore test.php?courseId=' + data.courseid);
            $('#testName').text(data.test_name);
            $('#courseName').text(data.course_name);

            // do test again
            document.getElementById('do_test_btn').onclick = function() {
                window.location.href = `do_test_page.php?testid=${data.testid}`;
            };

            var time_taken = data.time_taken;
            var totalQuestions = data.totalquestion;
            var rightAnswers = data.rightanswer;
            var wrongAnswers = totalQuestions - rightAnswers;
            var rightPercentage = (rightAnswers / totalQuestions) * 100;
            var wrongPercentage = (wrongAnswers / totalQuestions) * 100;
            $('#totalPoint').text(`${(rightPercentage / 10).toFixed(2)}/10`);
            $('#correctAns').text(`${rightAnswers}/${totalQuestions}`);
            $('#timeTaken').text(`${time_taken} minutes`);
            // Display test information
            console.log("Total Questions:", totalQuestions);
            console.log("Right Answers:", rightAnswers);
            console.log("Wrong Answers:", wrongAnswers);
            console.log("Right Percentage:", rightPercentage.toFixed(2) + "%");
            console.log("Wrong Percentage:", wrongPercentage.toFixed(2) + "%");
            const doughnutLabel = {
                id: 'doughnutLabel',
                beforeDatasetsDraw(chart, args, pluginOptions) {
                    const { ctx, data } = chart;
                    ctx.save();
                    const xCoor = chart.getDatasetMeta(0).data[0].x;
                    const yCoor = chart.getDatasetMeta(0).data[0].y;
                    ctx.font = 'bold 28px Arial';
                    ctx.textAlign = 'center';
                    ctx.fillStyle = '#737373';
                    ctx.fillText(`${rightPercentage.toFixed(2)} %`, xCoor, yCoor);
                }
            };
            // Draw doughnut chart
            var ctx = document.getElementById('doughnutChart').getContext('2d');
            var doughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Right Answers', 'Wrong Answers'],
                    datasets: [{
                        data: [rightAnswers, wrongAnswers],
                        backgroundColor: [
                            '#41C246', // Right answers color
                            '#F21717' // Wrong answers color
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    cutoutPercentage: 70,
                    animation: {
                        animateRotate: false
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Percentage of Right and Wrong Answers'
                    },
                },
                plugins: [doughnutLabel]
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching test data:', error);
        }
    });
});