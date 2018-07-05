<?php

require __DIR__ . "/../../vendor/autoload.php";

class InstructionPageViewTest extends \PHPUnit_Framework_TestCase
{
	public function test_constructor() {
        $nurikabe = new \Nurikabe\Nurikabe();
        $instructionPage = new \Nurikabe\InstructionPage($nurikabe);
        $view = new Nurikabe\InstructionPageView($instructionPage);
        $this->assertInstanceOf("Nurikabe\InstructionPageView", $view);
	}
}

/// @endcond
