<?php

require __DIR__ . "/../../vendor/autoload.php";
use Nurikabe\IndexPage as IndexPage;

class IndexPageTest extends \PHPUnit_Framework_TestCase
{
	public function test_construct(){
	    $nurikabe = new \Nurikabe\Nurikabe("Test Name");
	    $index = new IndexPage($nurikabe);
	    $this->assertInstanceOf('Nurikabe\IndexPage', $index);
	    $this->assertContains("Test", $index->getName());
    }
}

/// @endcond
