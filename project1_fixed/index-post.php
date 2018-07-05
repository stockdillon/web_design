<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$controller = new Nurikabe\NurikabeController($nurikabe, $_POST);

if($controller->isReset()) {
    //unset($_SESSION[NURIKABE_SESSION]);
}

if(!$controller->isValidName()){
    header("location: index.php");
    exit;
}

//var_dump($_POST);
//var_dump($nurikabe);
//echo "<a href='game.php'>game.php</a>";
header("location: game.php");
exit;