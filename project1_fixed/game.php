<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$view = new Nurikabe\GamePageView($gamePage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nifty Nurikabe Game</title>
    <link href="project1.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
if($view->getName() == '' or $view->getName() === null){
    header("location: index.php");
    exit;
}
?>
<?php echo $view->presentHeader(); ?>
<?php echo $view->presentGameBody(); ?>
<?php echo $view->presentFooter(); ?>
</body>
</html>