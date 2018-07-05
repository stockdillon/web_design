<?php

namespace Nurikabe;


class SolvedPage
{
    public function __construct(Nurikabe $nurikabe){
        $this->nurikabe = $nurikabe;
        $this->table = $nurikabe->getTable();
    }

    public function getName(){
        $this->name = $this->nurikabe->getName();
        return $this->name;
    }

    public function getTable(){
        return $this->table;
    }

    private $nurikabe;
    private $name;
    private $table;
}