<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\IndexPageView($indexPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nifty Nurikabe</title>
    <link href="project1.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php echo $view->presentHeader(); ?>
<?php echo $view->presentIndexBody(); ?>
<?php echo $view->presentFooter(); ?>
</body>
</html>