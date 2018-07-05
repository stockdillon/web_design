<?php


require __DIR__ . "/../../vendor/autoload.php";
use Nurikabe\Nurikabe as Nurikabe;

class NurikabeTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct(){
        $nurikabe = new Nurikabe();
        $this->assertInstanceOf('Nurikabe\Nurikabe', $nurikabe);
    }
}

/// @endcond
