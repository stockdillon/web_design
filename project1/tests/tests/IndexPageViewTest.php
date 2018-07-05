<?php

require __DIR__ . "/../../vendor/autoload.php";
use Nurikabe\IndexPageView as View;
use Nurikabe\IndexPage as IndexPage;

class IndexPageViewTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct(){
        $nurikabe = new \Nurikabe\Nurikabe("Test Name");
        $index = new IndexPage($nurikabe);
        $view = new View($index);

        $this->assertInstanceOf('Nurikabe\IndexPageView', $view);
    }
}

/// @endcond
