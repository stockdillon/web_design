<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\InstructionPageView($nurikabe);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head()?>
<body>
<?php echo $view->header(); ?>
<?php echo $view->presentInstructionBody(); ?>
<?php echo $view->footer(); ?>
</body>
</html>