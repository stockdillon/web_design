<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\GamePageView($nurikabe, $site, $_GET);
if($nurikabe->isSolved()){
    header('Location: ' . 'solved.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>


<body>
<?php echo $view->header(); ?>
<?php echo $view->presentGameBody(); ?>
<?php echo $view->footer(); ?>
</body>
</html>