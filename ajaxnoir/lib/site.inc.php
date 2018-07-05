<?php
/**
 * @file
 * A file loaded for all pages on the site.
 */
require __DIR__ . "/../vendor/autoload.php";

define("LOGIN_SESSION", "ajaxnoir_login");
define("LOGIN_COOKIE", "ajaxnoir_cookie");


// Start the session system
session_start();

// Create and localize the Site object
$site = new Noir\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
	$localize($site);
}

/*
 * Login functionality
 */

if(!isset($open)) {
    // This is a page other than the login pages
    if (!isset($_SESSION[LOGIN_SESSION])) {
        if(!isset($_COOKIE[LOGIN_COOKIE])){
            $root = $site->getRoot();
            header("location: $root/login.php");
            exit;
        }

        $cookie = json_decode($_COOKIE[LOGIN_COOKIE], true);
        if(!isset($cookie['user'])){
            // If not logged in, force to the login page
            $root = $site->getRoot();
            header("location: $root/login.php");
            exit;
        }


        // We have a valid cookie
        $user = $cookie['user'];
        $token = $cookie['token'];
        //var_dump($cookie);

        $cookies = new Noir\Cookies($site);
        $hash = $cookies->validate($user, $token);
        if( $hash !== null){
            $cookies->delete($hash);
            $newToken = $cookies->create($user);
        }


    } else {
        // We are logged in.
        $user = $_SESSION[LOGIN_SESSION]['user'];
    }
}

