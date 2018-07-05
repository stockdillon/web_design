<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\SolvedPageView($nurikabe);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>


<body>
<?php
/*
if($view->getName() == '' or $view->getName() === null){
    header("location: index.php");
    exit;
}
*/
?>
<?php echo $view->header(); ?>
<?php echo $view->presentSolvedBody(); ?>
<?php echo $view->footer(); ?>
</body>
</html>