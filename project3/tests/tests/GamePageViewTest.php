<?php

require __DIR__ . "/../../vendor/autoload.php";
use Nurikabe\GamePage as GamePage;
use Nurikabe\GamePageView as GamePageView;

class GamePageViewTest extends \PHPUnit_Framework_TestCase
{
	public function test_construct() {
	    $nurikabe = new \Nurikabe\Nurikabe("Game Page Test Name");
		$gamePage = new GamePage($nurikabe);
		$gamePageView = new GamePageView($gamePage);
		$this->assertInstanceOf('Nurikabe\GamePageView', $gamePageView);
		$this->assertContains("Game Page Test", $gamePage->getName());
	}
}

/// @endcond
