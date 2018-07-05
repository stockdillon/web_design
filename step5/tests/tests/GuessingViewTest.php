<?php

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
require __DIR__ . "/../../vendor/autoload.php";
use Guessing\Guessing as Guessing;
use Guessing\GuessingView as View;



class GuessingViewTest extends \PHPUnit_Framework_TestCase
{
    const SEED = 1234;

	public function test_construct() {
	    $guessing = new Guessing(self::SEED);
	    $view = new View($guessing);

        $this->assertInstanceOf('Guessing\GuessingView', $view);
	}

	public function test_present(){
        $guessing = new Guessing(self::SEED);
        $view = new View($guessing);
        $html = $view->present();
        $this->assertContains("Try to guess", $html);

        $guessing = new Guessing(self::SEED);
        $guessing->guess(0);
        $view = new View($guessing);
        $html = $view->present();
        $this->assertContains("guess of 0", $html);
        $this->assertContains("is invalid", $html);

        $guessing = new Guessing(self::SEED);
        $guessing->guess(101);
        $view = new View($guessing);
        $html = $view->present();
        $this->assertContains("guess of 101", $html);
        $this->assertContains("is invalid", $html);

        $guessing = new Guessing(self::SEED);
        $guessing->guess(23);
        $view = new View($guessing);
	    $html = $view->present();
        $this->assertContains("After 1 guesses", $html);
	    $this->assertContains("you are correct", $html);

        $guessing = new Guessing(self::SEED);
        $guessing->guess(99);
        $guessing->guess(18);
        $view = new View($guessing);
        $html = $view->present();
        $this->assertContains("After 2 guesses", $html);
        $this->assertContains("you are too low", $html);

        $guessing = new Guessing(self::SEED);
        $guessing->guess(15);
        $guessing->guess(16);
        $guessing->guess(55);
        $view = new View($guessing);
        $html = $view->present();
        $this->assertContains("After 3 guesses", $html);
        $this->assertContains("you are too high", $html);
    }

}

/// @endcond
