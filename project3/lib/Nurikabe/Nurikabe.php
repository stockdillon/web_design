<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/8/17
 * Time: 6:56 PM
 */

namespace Nurikabe;

class Nurikabe
{
    public function __construct($name = 'Name Error', $key= '3x3'){
        $this->name = $name;
        $this->key = $key;
        $this->table = new GameTable($key);
        $this->solvedTable = new SolvedGameTable($key);
    }

    public function getName(){
        return $this->name;
    }


    public function setName($name){
        $this->name = $name;
    }


    /*
    public function setTable($key){
        $this->table =
    }
    */

    public function getTable(){
        return $this->table;
    }

    public function setTable(){
        $this->table = new GameTable($this->key);
    }

    public function setSolvedTable(){
        $this->solvedTable = new SolvedGameTable($this->key);
    }

    public function getKey(){
        return $this->key;
    }

    public function setKey($key){
        $this->key = $key;
    }


    public function isSolved(){
        return $this->solved;
    }

    public function setSolved(){
        $this->solved = true;
    }

    public function unsetSolved(){
        $this->solved = false;
    }

    public function setGameActive(){
        $this->gameActive = true;
    }

    public function isGameActive(){
        return $this->gameActive;
    }

    public function setNameError(){
        $this->nameError = true;
    }

    public function getNameError(){
        return $this->nameError;
    }

    public function unsetBoolCheck(){
        $this->boolCheck = false;
    }

    public function getBoolCheck(){
        return $this->boolCheck;
    }

    public function getGameHTML(){
        $html = $this->table->getTableHTML();
        return $html;
    }

    public function getSolvedHTML(){
        $html = $this->solvedTable->getTableHTML();
        return $html;
    }

    public function clickCell($row, $col){
        $this->table->clickCell($row, $col);
    }



/*
    public function checkCell($row, $col){
        if($this->table[$row][$col] !== $this->solvedTable[$row][$col]){
            if($this->table[$row][$col] == Cell::SEA){
                $this->boolCheck = true;
                //$this->table[$row][$col] = Cell::RED_SEA;
                $this->redTable[$row][$col] = Cell::RED_SEA;
            }

if($this->table[$row][$col] == Cell::BLANK) {
    $this->table[$row][$col] = Cell::RED_BLANK;
}

            elseif($this->table[$row][$col] == Cell::ISLAND){
                $this->boolCheck = true;
                //$this->table[$row][$col] = Cell::RED_ISLAND;
                $this->redTable[$row][$col] = Cell::RED_ISLAND;
            }
        }
    }
*/


    private $gameActive = false;
    private $solved = false;
    private $key;
    private $name;
    private $table;
    private $solvedTable;
    private $nameError = false;
    //private $clickedCells;
}