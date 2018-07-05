<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$controller = new Nurikabe\LoginController($site, $_SESSION, $_POST);

//var_dump($_SESSION);
//var_dump($_GET);
//var_dump($_POST);
//var_dump($nurikabe);


/*
$href = $controller->getRedirect();
echo '<a href=' . $href . '>'.$href.'</a>';
//echo "<a href='login.php'>login.php</a>";
echo "<br>";
echo "redirecting to: " . $controller->getRedirect();
*/

//header("location: game.php");
header("location: " . $controller->getRedirect());
exit;