<?php

require __DIR__ . "/../../vendor/autoload.php";

class EmailMock extends Nurikabe\Email {
    public function mail($to, $subject, $message, $headers)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    public $to;
    public $subject;
    public $message;
    public $headers;
}


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
        $users = new Nurikabe\Users(self::$site);
        $this->assertInstanceOf('Nurikabe\Users', $users);
    }


    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Nurikabe\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_login() {
        $users = new Nurikabe\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("stockdil@msu.edu", "password");
        $this->assertInstanceOf('Nurikabe\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Nurikabe\User', $user);

        // Test a valid login based on email address
        $user = $users->login("stockdillon@yahoo.com", "password");
        $this->assertInstanceOf('Nurikabe\User', $user);
/*
        //$joined = $user->getJoined();
        //var_dump($joined);
        $joinedString = "$joined";
        //var_dump($joinedString);
        $this->assertContains('2017', $joinedString);
        $this->assertContains("999", $user->getPhone());
        $this->assertContains("Owen", $user->getName());
        $this->assertContains("8", $user->getId());
        $this->assertContains("Address", $user->getAddress());
        $this->assertContains("Notes", $user->getNotes());
*/

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);
    }

/*
    public function test_get(){
        $users = new Nurikabe\Users(self::$site);

        $user = $users->get(8);
        $this->assertInstanceOf('Nurikabe\User', $user);
        $this->assertContains("999", $user->getPhone());
        $this->assertContains("Owen", $user->getName());
        $this->assertContains("8", $user->getId());
        $this->assertContains("Address", $user->getAddress());
        $this->assertContains("Notes", $user->getNotes());
    }




    public function test_getClients() {
        $users = new Nurikabe\Users(self::$site);

        $clients = $users->getClients();

        $this->assertEquals(2, count($clients));
        $c0 = $clients[0];
        $this->assertEquals(2, count($c0));
        $this->assertEquals(9, $c0['id']);
        $this->assertEquals("Simpson, Bart", $c0['name']);
        $c1 = $clients[1];
        $this->assertEquals(10, $c1['id']);
        $this->assertEquals("Simpson, Marge", $c1['name']);
    }


    public function test_exists() {
        $users = new Nurikabe\Users(self::$site);

        $this->assertTrue($users->exists("dudess@dude.com"));
        $this->assertFalse($users->exists("dudess"));
        $this->assertFalse($users->exists("cbowen"));
        $this->assertTrue($users->exists("cbowen@cse.msu.edu"));
        $this->assertFalse($users->exists("nobody"));
        $this->assertFalse($users->exists("7"));
    }


    public function test_add() {
        $users = new Nurikabe\Users(self::$site);

        $mailer = new EmailMock();

        $user7 = $users->get(7);
        $this->assertContains("Email address already exists",
            $users->add($user7, $mailer));

        $row = array('id' => 0,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'phone' => '123-456-7890',
            'address' => 'Some Address',
            'notes' => 'Some Notes',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
            'role' => 'S'
        );
        $user = new Nurikabe\User($row);
        $users->add($user, $mailer);

        $table = $users->getTableName();
        $sql = <<<SQL
select * from $table where email='dude@ranch.com'
SQL;

        $stmt = $users->pdo()->prepare($sql);
        $stmt->execute();
        $this->assertEquals(1, $stmt->rowCount());

        $this->assertEquals("dude@ranch.com", $mailer->to);
        $this->assertEquals("Confirm your email", $mailer->subject);
    }
*/


    public function test_setPassword() {
        $users = new Nurikabe\Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("stockdil@msu.edu", "password");
        $this->assertNotNull($user);
        $this->assertEquals("Dillon", $user->getName());

        // Change the password
        $users->setPassword(2, "newpassword");

        // Old password should not work
        $user = $users->login("stockdil@msu.edu", "password");
        $this->assertNull($user);

        // New password does work!
        $user = $users->login("stockdil@msu.edu", "newpassword");
        $this->assertNotNull($user);
        $this->assertEquals("Dillon", $user->getName());
    }



}

/// @endcond
