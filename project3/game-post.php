<?php
require __DIR__ . '/lib/Nurikabe.inc.php';
$controller = new Nurikabe\GameController($site, $nurikabe, $_POST, $_SESSION);


$key = $nurikabe->getKey();
//echo $key;
$getTable = new \Nurikabe\GetTable();
$clearTable = $getTable->getTable($key);
$solvedTable = $getTable->getSolvedTable($key);

echo json_encode(array($clearTable, $solvedTable));
