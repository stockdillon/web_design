<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$controller = new Nurikabe\GameController($nurikabe, $_POST);
if($controller->isReset()) {
    //unset($_SESSION[NURIKABE_SESSION]);
}


//var_dump($_POST);
//var_dump($nurikabe);
//echo "<a href='game.php'>game.php</a>";
//echo "<br>";
//echo "<a href='solved.php'>solved.php</a>";
//header("location: game.php");
header('Location: ' . $controller->getPage());
exit;