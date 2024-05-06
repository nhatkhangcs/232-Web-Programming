<?php
// Assuming CreateDocx.php is in the same directory
require_once '../phpdocx/classes/CreateDocx.php';

// Start output buffering
ob_start();

// Retrieve JSON data from the AJAX request
$json_data = file_get_contents('php://input');

$data = json_decode($json_data);

echo json_encode($data);
// Create a new instance of CreateDocx
$docx = new CreateDocx();

// Add test information to the document
$docx->addText($data->testName);
$docx->addText($data->courseName);
$docx->addText($data->testDescription);
$docx->addText($data->testDuration);

// Add questions to the document
foreach ($data->questions as $index => $question) {
    // Print the question
    $docx->addText("Question " . ($index + 1) . ": " . $question->questionText);
    
    // Print the image if available
    if (!empty($question->image)) {
        // Scale the image to a smaller size (e.g., 200x200 pixels)
        $desiredWidth = 450;
        $desiredHeight = 200;
        
        // Get the dimensions of the original image
        list($originalWidth, $originalHeight) = getimagesize('../image/test/' . $question->image);
        
        // Calculate the aspect ratio
        $aspectRatio = $originalWidth / $originalHeight;
        
        // Calculate the scaled dimensions
        if ($aspectRatio >= 1) {
            // Landscape or square image
            $newWidth = $desiredWidth;
            $newHeight = $desiredWidth / $aspectRatio;
        } else {
            // Portrait image
            $newHeight = $desiredHeight;
            $newWidth = $desiredHeight * $aspectRatio;
        }
    
        // Add the scaled image
        $docx->addImage(array(
            'src' => '../image/test/' . $question->image,
            'width' => $newWidth,
            'height' => $newHeight
        ));
    }
    // Print option A
    // echo "$question->optionA";
    // echo "$question->optionB";
    // echo "$question->optionC";
    // echo "$question->optionD";

    // var optionsArray = [question.optionA, question.optionB, question.optionC, question.optionD];

    // add to docx
    $docx->addText("A. " . $question->options[0]);
    $docx->addText("B. " . $question->options[1]);
    $docx->addText("C. " . $question->options[2]);
    $docx->addText("D. " . $question->options[3]);
}


// Generate the DOCX file
$docx->createDocx('exported_test');

// Capture the output and headers
$content = ob_get_clean();

// Set headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="exported_test.docx"');

// Output the captured content
echo $content;
?>
