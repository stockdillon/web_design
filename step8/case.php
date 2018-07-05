<?php
require 'lib/site.inc.php';
$view = new Felis\CaseView($site, $_GET['id']);
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
<div class="case">
    <?php
    var_dump($_GET);
    echo $view->header();
    echo $view->presentCase();
    echo $view->footer();
    ?>
</div>
</body>
</html>
