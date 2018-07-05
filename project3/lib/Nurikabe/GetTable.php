<?php

namespace Nurikabe;
class GetTable {

    public function __construct()
    {
        //$this->key = $key;
    }

    public function getTable($key){
        return $this->tables[$key];
    }

    public function getSolvedTable($key){
        return $this->solvedTables[$key];
    }

    private $key;
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