<?php
//$open = true;
//require 'lib/site.inc.php';
//$site = new Nurikabe\Site();
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\NewUserView($_SESSION, $_GET);
?>

<!DOCTYPE html>
<html lang="en">
<?php echo $view->head(); ?>

<body>
<?php echo $view->header(); ?>
<?php echo $view->presentNewUserBody(); ?>
<?php echo $view->footer(); ?>
</body>
</html>