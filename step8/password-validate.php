<?php
$open = true;
require 'lib/site.inc.php';
$view = new Felis\PasswordValidateView($site, $_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="password">

    <?php echo $view->header(); ?>
    <?php echo $view->presentPasswordValidate(); ?>
    <?php echo $view->footer(); ?>

</div>

</body>
</html>