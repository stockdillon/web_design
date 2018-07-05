<?php

require __DIR__ . "/../vendor/autoload.php";

session_start();

define("NURIKABE_SESSION", 'nurikabe');


if(!isset($_SESSION[NURIKABE_SESSION])) {
    $_SESSION[NURIKABE_SESSION] = new Nurikabe\Nurikabe();
    header("location: index.php");
    exit;
}



$nurikabe = $_SESSION[NURIKABE_SESSION];
$indexPage = new Nurikabe\IndexPage($nurikabe);
$gamePage = new Nurikabe\GamePage($nurikabe);
$instructionPage = new \Nurikabe\InstructionPage($nurikabe);
$solvedPage = new Nurikabe\SolvedPage($nurikabe);