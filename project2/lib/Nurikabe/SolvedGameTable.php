<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 7:09 PM
 */

namespace Nurikabe;


class SolvedGameTable extends GameTable
{
    /*
    public function __construct($key)
    {
        parent::__construct($key);
        $getSolvedTable = new GetTable($key);
        $this->table = $getSolvedTable->getSolvedTable();
    }
    */



    public function __construct($key)
    {
        $this->num = 3;
        if($key == '3x3'){$this->num=3;}
        if($key == '8x8easy'){$this->num=8;}
        if($key == '8x8med'){$this->num=8;}
        if($key == '10x10'){$this->num=10;}


        $getTable = new GetTable();
        $this->table = $getTable->getSolvedTable($key);

    }

    public function getClickedCells(){
        return $this->table;
    }



    public function clickCell($row, $col)
    {
        if ($this->table[$row][$col] == Cell::BLANK or $this->table[$row][$col] == Cell::RED_BLANK) {
            //$this->cellClicked = "$row,$col";
            $this->table[$row][$col] = Cell::SEA;
            //$this->redTable[$row][$col] = Cell::SEA;
        } elseif ($this->table[$row][$col] == Cell::SEA or $this->table[$row][$col] == Cell::RED_SEA) {
            //$this->cellClicked = "$row,$col";
            $this->table[$row][$col] = Cell::ISLAND;
            //$this->redTable[$row][$col] = Cell::ISLAND;
        } elseif ($this->table[$row][$col] == Cell::ISLAND or $this->table[$row][$col] == Cell::RED_ISLAND) {
            //$this->cellClicked = "$row,$col";
            $this->table[$row][$col] = Cell::BLANK;
            //$this->redTable[$row][$col] = Cell::BLANK;
        }
    }



    public function getTableHTML(){
        $html = '';
        $rowNum = 0;
        $table = $this->table;
        foreach($table as $row){
            $colNum = 0;
            $html .= '<tr>';
            foreach($row as $cell){
                $name = "$rowNum,$colNum";
                if($cell == Cell::BLANK){
                    $class = 'empty';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::SEA){
                    $class = 'blue_cell';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::ISLAND){
                    $class = 'island';
                    $value = '&#9679;';
                }
                elseif($cell == Cell::RED_BLANK){
                    $class = 'red_cell';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::RED_SEA){
                    $class = 'red_sea';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::RED_ISLAND){
                    $class = 'red_island';
                    $value = '&#9679;';
                }
                if($cell == Cell::BLANK or $cell == Cell::SEA or $cell == Cell::ISLAND or $cell == Cell::RED_BLANK or $cell == Cell::RED_ISLAND or $cell == Cell::RED_SEA) {
                    //$html .= "<td><div class=$class><input type='submit' name=$name value =$value></div></td>"; // change this to instead append the appropriate html and tags
                    $html .= "<td class='cell'><div class=$class><input type='submit' name=$name value =$value></div></td>"; // change this to instead append the appropriate html and tags

                }

                else{$html .= "<td><div class='locked'>$cell</div></td>";}
                $colNum++;
            }
            $html .= '</tr>';
            $rowNum++;
        }
        return $html;
    }


    private $table;
    private $num;

}
















/*
    public function clickCell($row, $col){
        if($this->table[$row][$col] == Cell::BLANK or $this->table[$row][$col] == Cell::RED_BLANK){
            $this->cellClicked = "$row,$col";
            $this->table[$row][$col] = Cell::SEA;
            $this->redTable[$row][$col] = Cell::SEA;
        }

        elseif($this->table[$row][$col] == Cell::SEA or $this->table[$row][$col] == Cell::RED_SEA){
            $this->cellClicked = "$row,$col";
            $this->table[$row][$col] = Cell::ISLAND;
            $this->redTable[$row][$col] = Cell::ISLAND;
        }
        elseif($this->table[$row][$col] == Cell::ISLAND or $this->table[$row][$col] == Cell::RED_ISLAND){
            $this->cellClicked = "$row,$col";
            $this->table[$row][$col] = Cell::BLANK;
            $this->redTable[$row][$col] = Cell::BLANK;
        }

        //if($this->table == $this->solvedTable){
        $tableCompare = new TableCompare($this->table, $this->key);
        if($tableCompare->isTableSolved()){
            $this->solved = true;
            $this->nextPage = 'solved.php';
        }
    }



        public
        function getTableHTML()
        {
            $html = '';
            $rowNum = 0;
            //$table = $this->gamePage->getTable();
            $table = $this->nurikabe->getTable();
            if ($this->gamePage->getBoolCheck()) {
                $table = $this->gamePage->getRedTable();
            }
            foreach ($table as $row) {
                $colNum = 0;
                $html .= '<tr>';
                foreach ($row as $cell) {
                    $name = "$rowNum,$colNum";
                    if ($cell == Cell::BLANK) {
                        $class = 'empty';
                        $value = '&nbsp;';
                    } elseif ($cell == Cell::SEA) {
                        $class = 'blue_cell';
                        $value = '&nbsp;';
                    } elseif ($cell == Cell::ISLAND) {
                        $class = 'island';
                        $value = '&#9679;';
                    } elseif ($cell == Cell::RED_BLANK) {
                        $class = 'red_cell';
                        $value = '&nbsp;';
                    } elseif ($cell == Cell::RED_SEA) {
                        $class = 'red_sea';
                        $value = '&nbsp;';
                    } elseif ($cell == Cell::RED_ISLAND) {
                        $class = 'red_island';
                        $value = '&#9679;';
                    }
                    if ($cell == Cell::BLANK or $cell == Cell::SEA or $cell == Cell::ISLAND or $cell == Cell::RED_BLANK or $cell == Cell::RED_ISLAND or $cell == Cell::RED_SEA) {
                        //$html .= "<td><div class=$class><input type='submit' name=$name value =$value></div></td>"; // change this to instead append the appropriate html and tags
                        $html .= "<td class='cell'><div class=$class><input type='submit' name=$name value =$value></div></td>"; // change this to instead append the appropriate html and tags

                    } else {
                        $html .= "<td><div class='locked'>$cell</div></td>";
                    }
                    $colNum++;
                }
                $html .= '</tr>';
                $rowNum++;
            }
            return $html;
        }
    }
*/



