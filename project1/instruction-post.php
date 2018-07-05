<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$controller = new Nurikabe\NurikabeController($nurikabe, $_POST);
if($controller->isReset()) {
    unset($_SESSION[NURIKABE_SESSION]);
}
print_r($_POST);
var_dump($_POST);
var_dump($nurikabe);
//header("location: instruction.php");
exit;