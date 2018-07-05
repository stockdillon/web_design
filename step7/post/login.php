<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

if( isset($_GET['e'])){
    set($_POST['InvalidLogin']);
}
$controller = new Felis\LoginController($site, $_SESSION, $_POST);
header("location: " . $controller->getRedirect());