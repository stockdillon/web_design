<?php

require __DIR__ . "/../../vendor/autoload.php";


class LoginControllerTest extends \PHPUnit_Extensions_Database_TestCase
{

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }

    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'stockdil');
    }

    public function test_construct() {
        $session = array();	// Fake session
        $root = self::$site->getRoot();

        // Valid staff login
        $controller = new Felis\LoginController(self::$site, $session,
            array("email" => "cbowen@cse.msu.edu", "password" => "super477"));

        $this->assertEquals("Owen, Charles", $session[Felis\User::SESSION_NAME]->getName());
        $this->assertEquals("$root/staff.php", $controller->getRedirect());

        // Valid client login
        $controller = new Felis\LoginController(self::$site, $session,
            array("email" => "bart@bartman.com", "password" => "bart477"));

        $this->assertEquals("Simpson, Bart", $session[Felis\User::SESSION_NAME]->getName());
        $this->assertEquals("$root/client.php", $controller->getRedirect());

        // Invalid login
        $controller = new Felis\LoginController(self::$site, $session,
            array("email" => "bart@bartman.com", "password" => "wrongpassword"));

        $this->assertNull($session[Felis\User::SESSION_NAME]);
        $this->assertEquals("$root/login.php?e", $controller->getRedirect());
    }


    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    private static $site;

}

/// @endcond
