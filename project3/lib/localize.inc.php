<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Nurikabe\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('stockdil@cse.msu.edu');
    $site->setRoot('/~stockdil/project2');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=stockdil',
        'stockdil',       // Database user
        'password',     // Database password
        'project2_');            // GameTable prefix
};
