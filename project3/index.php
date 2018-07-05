<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
//require 'lib/site.inc.php';
$site = new Nurikabe\Site();
$view = new Nurikabe\IndexPageView($site, $_SESSION, $_GET);
?>

<!DOCTYPE html>
<html lang="en">

<?php echo $view->head(); ?>

<body>
<?php echo $view->header(); ?>
<?php echo $view->presentIndexBody(); ?>
<?php echo $view->footer(); ?>
</body>
</html>