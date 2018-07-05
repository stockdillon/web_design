<?php

namespace Nurikabe;


class GamePage
{
    public function __construct(Nurikabe $nurikabe){
        $this->nurikabe = $nurikabe;
        $this->name = $nurikabe->getName();
        $this->difficulty = $nurikabe->getDifficulty();
        $this->table= $nurikabe->getTable();
        $this->boolCheck = $this->nurikabe->getBoolCheck();
        $this->redTable = $this->nurikabe->getRedTable();
        if($this->nurikabe->getTable() == $this->nurikabe->getSolvedTable()){
            $this->isSolved = true;
        }
        else{$this->isSolved = false;}
        /*
        if(strpos($this->difficulty, 'Ultra') !== false) {
            $this->key = '3x3';
            $this->nurikabe->setKey($this->key);
            $this->nurikabe->setTableSize(3);
            $this->table = $this->tables['3x3'];
            $this->nurikabe->setTable($this->table);
            $this->solvedTable = $this->solvedTables['3x3'];
        }
        elseif(strpos($this->difficulty, 'Very')){
            $this->key = '8x8easy';
            $this->nurikabe->setKey($this->key);
            $this->table = $this->tables['8x8easy'];
            $this->nurikabe->setTable($this->table);
            $this->solvedTable = $this->solvedTables['8x8easy'];
        }
        elseif(strpos($this->difficulty, 'Medium')){
            $this->key = '8x8med';
            $this->nurikabe->setKey($this->key);
            $this->table = $this->tables['8x8med'];
            $this->nurikabe->setTable($this->table);
            $this->solvedTable = $this->solvedTables['8x8med'];
        }
        else{
            $this->key = '10x10';
            $this->nurikabe->setKey($this->key);
            $this->table = $this->tables['10x10'];
            $this->nurikabe->setTable($this->table);
            $this->solvedTable = $this->solvedTables['10x10'];
        }
        */

    }

    public function getNameError(){
        return $this->nameError;
    }

    public function getIsSolved(){
        return $this->isSolved;
    }

    public function getKey(){
        return $this->key;
    }

    public function getName(){
        return $this->name;
    }

    public function getTableArray(){
        return $this->table;
    }

    public function getSolvedTable(){
        return $this->solvedTable;
    }

    public function getBoolCheck(){
        return $this->boolCheck;
    }

    public function getRedTable(){
        return $this->redTable;
    }

    public function getTable(){
        return $this->table;
    }

    private $boolCheck = false;
    private $redTable;
    private $isSolved;
    private $difficulty;
    private $nurikabe;
    private $name;
    private $table;
    private $solvedTable;
    private $key;
/*
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
*/

}