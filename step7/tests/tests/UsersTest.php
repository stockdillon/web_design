<?php

require __DIR__ . "/../../vendor/autoload.php";


class UsersTest extends \PHPUnit_Extensions_Database_TestCase
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
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('Felis\Users', $users);
    }


    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);
        $joined = $user->getJoined();
        //var_dump($joined);
        $joinedString = "$joined";
        //var_dump($joinedString);
        $this->assertContains('2017', $joinedString);
        $this->assertContains("999", $user->getPhone());
        $this->assertContains("Owen", $user->getName());
        $this->assertContains("8", $user->getId());
        $this->assertContains("Address", $user->getAddress());
        $this->assertContains("Notes", $user->getNotes());


        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);
    }


    public function test_get(){
        $users = new Felis\Users(self::$site);

        $user = $users->get(8);
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertContains("999", $user->getPhone());
        $this->assertContains("Owen", $user->getName());
        $this->assertContains("8", $user->getId());
        $this->assertContains("Address", $user->getAddress());
        $this->assertContains("Notes", $user->getNotes());
    }

}

/// @endcond
