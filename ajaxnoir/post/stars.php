<?php
$open = true;
require '../lib/site.inc.php';

$controller = new Noir\StarController($site, $site->getUser(), $_POST);
echo $controller->getResult();