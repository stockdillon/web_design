<?php
require __DIR__ . "/../../vendor/autoload.php";

class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function test_constructor()
    {
        $site = new Felis\Site();
        $this->assertInstanceOf('Felis\Site', $site);
    }


    public function test_GettersAndSetters(){
        $site = new Felis\Site();
        $site->dbConfigure('host', 'user', 'password', 'prefix');
        $site->setEmail('email');
        $this->assertContains('email', $site->getEmail());
        $site->setRoot('root');
        $this->assertContains('root', $site->getRoot());
        $this->assertContains('prefix', $site->getTablePrefix());
    }


    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test_', $site->getTablePrefix());
    }


}

/// @endcond
