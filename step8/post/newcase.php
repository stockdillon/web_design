<?php
require '../lib/site.inc.php';

$controller = new Felis\NewCaseController($site, $user, $_POST);
header("location: " . $controller->getRedirect());

echo "<pre>";
print_r($_POST);
echo "</pre>";

