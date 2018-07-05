<?php

require __DIR__ . "/../../vendor/autoload.php";

class SolvedPageViewTest extends \PHPUnit_Framework_TestCase
{
	public function test_constructor() {
		$nurikabe = new \Nurikabe\Nurikabe();
		$solvedPage = new \Nurikabe\SolvedPage($nurikabe);
		$view = new Nurikabe\SolvedPageView($solvedPage);
		$this->assertInstanceOf("Nurikabe\SolvedPageView", $view);
	}
}

/// @endcond
