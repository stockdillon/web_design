<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/9/17
 * Time: 10:37 PM
 */

namespace Nurikabe;


class Cell
{
    //const SEA = "<div class='blue_cell'><button>&nbsp;</button></div>";
    //const ISLAND = "<div class='island'><button>&#9679;</button></div>";
    //const BLANK = "<div class='empty'><p><input type='submit' name='0,0' value ='&nbsp;'></p></div>";

    const SEA = 'sea';
    const ISLAND ='island';
    const BLANK = 'blank';

    //const RED = "<div class='red_cell'>&nbsp;</div>";
    const RED_BLANK = 'red_blank';
    const RED_ISLAND = 'red_island';
    const RED_SEA = 'red_sea';

    public function __construct($row, $col){
        $this->row = $row;
        $this->col = $col;
    }

    public function getRow(){
        return $this->row;
    }

    public function getCol(){
        return $this->col;
    }

    private $row;
    private $col;
}