<?php


require __DIR__ . "/../../vendor/autoload.php";
use Nurikabe\GamePage as GamePage;

class GamePageTest extends \PHPUnit_Framework_TestCase
{
	public function test_construct() {
		$nurikabe = new \Nurikabe\Nurikabe("Game Name");
		$gamePage = new \Nurikabe\GamePage($nurikabe);

		$this->assertInstanceOf("Nurikabe\GamePage", $gamePage);
	}

	public function test_getName(){
        $nurikabe = new \Nurikabe\Nurikabe("Game Name");
        $gamePage = new \Nurikabe\GamePage($nurikabe);

        $this->assertContains("Game Name", $gamePage->getName());
    }
}

/// @endcond
