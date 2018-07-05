<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$controller = new Nurikabe\GameController($nurikabe, $_POST);

var_dump($_POST);
//var_dump($nurikabe);
echo "<a href='game.php'>game.php</a>";
echo "<br>";
echo "<a href='index.php'>solved.php</a>";
header("location: game.php");
//header('Location: ' . $controller->getPage());
exit;