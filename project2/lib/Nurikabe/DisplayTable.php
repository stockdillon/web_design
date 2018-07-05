<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 6:59 PM
 */

namespace Nurikabe;


class DisplayTable
{
    public function __construct($table, $key, $clickedCells){
        $this->num = 3;
        if($key == '3x3'){$this->num=3;};
        if($key == '8x8easy'){$this->num=8;};
        if($key == '8x8med'){$this->num=8;};
        if($key == '10x10'){$this->num=10;};
        $this->table = $table;
        $this->key = $key;
        $this->clickedCells = $clickedCells;
    }


    public function display(){

    }


    public function displayCheck(){

    }


    private $table;
    private $key;
    private $clickedCells;
}
