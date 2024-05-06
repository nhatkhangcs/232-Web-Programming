<?php
// process the variables (placeholders) from an existing DOCX to clean them

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateVariables_symbols.docx');
$docx->setTemplateSymbol('${', '}');

//You may include manually the list of variables that should be preprocessed or use
//the getTemplateVariables method for an automatic listing
$variables = $docx->getTemplateVariables();
$docx->processTemplate($variables);

$docx->createDocx('example_processTemplate_2');