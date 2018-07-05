<?php

namespace Nurikabe;


class GamePage
{
    public function __construct(Nurikabe $nurikabe){
        $this->nurikabe = $nurikabe;
        $this->name = $nurikabe->getName();
        $this->table= $nurikabe->getTable();
        //$tableCompare = new TableCompare($this->nurikabe->getTable(), $this->nurikabe->getKey());
        //if($tableCompare->isTableSolved())

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
    private $isSolved;
    private $nurikabe;
    private $name;
    private $table;
    private $key;

}