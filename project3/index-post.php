<?php
require __DIR__ . '/lib/Nurikabe.inc.php';

if(isset($_GET['logout'])){
    unset($_SESSION['user']);
    header('Location: index.php');
    exit;
}

$controller = new Nurikabe\IndexController($nurikabe, $_SESSION, $_POST);

if($controller->isReset()) {
    unset($_SESSION[NURIKABE_SESSION]);
}

/*
echo "site: <br>";
var_dump($site);

echo "nurikabe: <br>";
var_dump($nurikabe);

echo "session: <br>";
var_dump($_SESSION);

echo "post: <br>";
var_dump($_POST);


echo '<a href=' . $controller->getRedirect() . '>'.$controller->getRedirect() .'</a>';
echo "<br>";
echo "redirecting to: " . $controller->getRedirect();
echo "<br><br>";
echo '<a href='.'game.php'.'>'.'game.php'.'</a>';
*/

header('Location: ' . $controller->getRedirect());
exit;