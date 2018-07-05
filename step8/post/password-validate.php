<?php
$open = true;
require '../lib/site.inc.php';

$controller = new Felis\PasswordValidateController($site, $_POST);
header("location: " . $controller->getRedirect());
//var_dump($_POST);
//var_dump($controller->getRedirect());