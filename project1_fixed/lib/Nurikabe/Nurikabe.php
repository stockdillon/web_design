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
    public function __construct($name = ''){
        $this->name = $name;
        $this->boolCheck = false;
        $this->redTable = $this->table;
    }

    public function getName(){
        return $this->name;
    }

    public function getDifficulty(){
        return $this->difficulty;
    }


    public function setName($name){
        $this->name = $name;
    }

    public function setDifficulty($difficulty){
        $this->difficulty = $difficulty;
    }

    public function setTable($key){
        $this->table = $this->tables[$key];
        $this->redTable = $this->tables[$key];
    }

    public function setSolvedTable($key){
        $this->solvedTable = $this->solvedTables[$key];
    }

    public function getSolvedTable(){
        return $this->solvedTable;
    }

    public function getTable(){
        return $this->table;
    }

    public function getKey(){
        return $this->key;
    }

    public function setKey($key){
        $this->key = $key;
    }

    public function setTableSize($size){
        $this->tableSize = $size;
    }

    public function getTableSize(){
        return $this->tableSize;
    }

    public function getNextPage(){
        return $this->nextPage;
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

    public function getRedTable(){
        return $this->redTable;
    }

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
        if($this->table == $this->solvedTable){
            $this->solved = true;
            $this->nextPage = 'solved.php';
        }
    }

    public function checkCell($row, $col){
        if($this->table[$row][$col] !== $this->solvedTable[$row][$col]){
            if($this->table[$row][$col] == Cell::SEA){
                $this->boolCheck = true;
                //$this->table[$row][$col] = Cell::RED_SEA;
                $this->redTable[$row][$col] = Cell::RED_SEA;
            }
            /*
if($this->table[$row][$col] == Cell::BLANK) {
    $this->table[$row][$col] = Cell::RED_BLANK;
}
*/
            elseif($this->table[$row][$col] == Cell::ISLAND){
                $this->boolCheck = true;
                //$this->table[$row][$col] = Cell::RED_ISLAND;
                $this->redTable[$row][$col] = Cell::RED_ISLAND;
            }
        }
    }

    public function makeBlueCell($row, $col){
        if($this->table[$row][$col] == Cell::RED_SEA){
            $this->table[$row][$col] = Cell::SEA;
        }
        elseif($this->table[$row][$col] == Cell::RED_ISLAND){
            $this->table[$row][$col] = Cell::ISLAND;
        }
    }

    private $boolCheck = false;
    private $redTable;
    private $gameActive = false;
    private $solved = false;
    private $nextPage = 'game.php';
    private $cellClicked;
    private $tableSize;
    private $key;
    private $name;
    private $difficulty;
    private $table;
    private $solvedTable;
    private $nameError = false;

    private $tables =[
        '3x3' => [
            [1,         Cell::BLANK,   1],
            [Cell::BLANK,  Cell::BLANK,  Cell::BLANK],
            [2,         Cell::BLANK,   Cell::BLANK]
        ],
        '8x8easy' => [
            [Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,1,Cell::BLANK,Cell::BLANK,Cell::BLANK,4,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [4,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,3,Cell::BLANK,Cell::BLANK,Cell::BLANK,3],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,3,Cell::BLANK,Cell::BLANK]
        ],
        '8x8med' => [
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,4,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK,6],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [5,Cell::BLANK,Cell::BLANK,Cell::BLANK,4,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK]
        ],
        '10x10' => [
            [4,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,1],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,3,Cell::BLANK,3,Cell::BLANK],
            [Cell::BLANK,2,Cell::BLANK,3,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [1,Cell::BLANK,Cell::BLANK,Cell::BLANK,4,Cell::BLANK,Cell::BLANK,3,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,5],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,1,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,4,Cell::BLANK,Cell::BLANK,3,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK],
            [Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,2,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK,Cell::BLANK]
        ]
    ];


    private $solvedTables = [
        '3x3' => [
            [1,   CELL::SEA,   1],
            [CELL::SEA, CELL::SEA , CELL::SEA ],
            [2,   CELL::ISLAND , CELL::SEA ]
        ],
        '8x8easy' => [
            [CELL::SEA,CELL::SEA,2,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA],
            [CELL::SEA,1,CELL::SEA,CELL::SEA,CELL::SEA,4,CELL::ISLAND,CELL::SEA],
            [CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,2,CELL::SEA,CELL::ISLAND,CELL::SEA],
            [CELL::SEA,2,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,CELL::SEA],
            [4,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,2,CELL::SEA,CELL::SEA],
            [CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND],
            [CELL::ISLAND,CELL::SEA,CELL::ISLAND,3,CELL::SEA,CELL::ISLAND,CELL::SEA,3],
            [CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,3,CELL::SEA,CELL::ISLAND]
        ],
        '8x8med' => [
            [CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA],
            [2,CELL::SEA,CELL::ISLAND,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::ISLAND,CELL::ISLAND],
            [CELL::SEA,4,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND],
            [CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,2,CELL::ISLAND,CELL::SEA,6],
            [CELL::SEA,CELL::ISLAND,CELL::SEA,2,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND],
            [CELL::SEA,2,CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::SEA],
            [5,CELL::SEA,CELL::SEA,CELL::SEA,4,CELL::ISLAND,CELL::ISLAND,CELL::SEA],
            [CELL::ISLAND,CELL::ISLAND,CELL::ISLAND,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA]
        ],
        '10x10' => [
            [4,CELL::ISLAND,CELL::ISLAND,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,1],
            [CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::SEA],
            [CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::ISLAND,CELL::SEA,3,CELL::SEA,3,CELL::SEA],
            [CELL::SEA,2,CELL::SEA,3,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,CELL::SEA],
            [1,CELL::SEA,CELL::SEA,CELL::SEA,4,CELL::ISLAND,CELL::SEA,3,CELL::SEA,CELL::SEA],
            [CELL::SEA,CELL::SEA,2,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::SEA,5],
            [CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::ISLAND,CELL::SEA,CELL::ISLAND],
            [CELL::SEA,CELL::ISLAND,CELL::SEA,1,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND],
            [CELL::SEA,CELL::ISLAND,4,CELL::SEA,CELL::SEA,3,CELL::ISLAND,CELL::ISLAND,CELL::SEA,CELL::ISLAND],
            [CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND,2,CELL::SEA,CELL::SEA,CELL::SEA,CELL::SEA,CELL::ISLAND]
        ]
    ];
}