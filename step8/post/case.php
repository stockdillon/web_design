<?php
require '../lib/site.inc.php';

$controller = new Felis\CaseController($site, $user, $_POST);
//header("location: " . $controller->getRedirect());

echo "post: <br>";
var_dump($_POST);

/*
echo "get: <br>";
var_dump($_GET);

echo "session: <br>";
var_dump($_SESSION);
*/

echo "redirect: <br>";
var_dump($controller->getRedirect());