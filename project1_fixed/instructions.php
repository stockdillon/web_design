<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\InstructionPageView($instructionPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructions</title>
    <link href="project1.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $view->presentHeader(); ?>
<?php echo $view->presentInstructionBody(); ?>
<?php echo $view->presentFooter(); ?>
</body>
</html>