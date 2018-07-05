
<?php


require __DIR__ . "/../vendor/autoload.php";

session_start();

define("NURIKABE_SESSION", 'nurikabe');


if(!isset($_SESSION[NURIKABE_SESSION])) {
    $_SESSION[NURIKABE_SESSION] = new Nurikabe\Nurikabe();
    header("location: index.php");
    exit;
}



$site = new Nurikabe\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}


$nurikabe = $_SESSION[NURIKABE_SESSION];


