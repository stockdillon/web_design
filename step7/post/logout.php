<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';
//unset($_SESSION['user']);
unset($_SESSION[Felis\User::SESSION_NAME]);


//$controller = new Felis\LoginController($site, $_SESSION, $_POST)
//header("location: " . $controller->getRedirect());
$root = $site->getRoot();
header("location: " . "$root/");