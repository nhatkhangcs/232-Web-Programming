<?php
$testData = array(
    "testname" => "Sample Test Name",
    "description" => "Sample Test Information",
    "timelimit" => "60 minutes",
    "questions" => array(
        array(
            "question" => "Sample Question 1",
            "options" => array("Option 1", "Option 2", "Option 3")
        ),
        array(
            "question" => "Sample Question 2",
            "options" => array("Option A", "Option B", "Option C")
        ),
        // Add more sample questions as needed
    )
);

// Output the JSON object
echo json_encode($testData);
?>