<?php
require 'lib/site.inc.php';
$view = new Felis\UserView($site);
if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="user">
    <?php echo $view->header(); ?>
    <?php echo $view->presentUser(); ?>
    <?php echo $view->footer(); ?>
</div>
</body>
</html>
