<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/9/17
 * Time: 12:19 AM
 */

namespace Nurikabe;


class GameController
{
    public function __construct(Nurikabe $nurikabe, $post){
        $this->nurikabe = $nurikabe;
        $this->name = $this->nurikabe->getName();
        for($i = 0; $i<$this->nurikabe->getTableSize(); $i++){
            for($j=0; $j<$this->nurikabe->getTableSize(); $j++){
                if(isset($post["$i,$j"])){
                    $this->nurikabe->clickCell($i, $j);
                }
            }
        }

        if($this->nurikabe->getTable() == $this->nurikabe->getSolvedTable()){
            $this->nextPage = 'solved.php';
        }

        if(isset($post['solved'])){
            $this->nextPage = "solved.php";
            $this->nurikabe->setSolved();
        }

        if(isset($post['clear'])){
            $key = $this->nurikabe->getKey();
            $this->nurikabe->setTable($key);
        }

        if(isset($post['check'])){
            for($i = 0; $i<$this->nurikabe->getTableSize(); $i++){
                for($j=0; $j<$this->nurikabe->getTableSize(); $j++){
                    $this->nurikabe->checkCell($i, $j);
                }
            }
        }

    }

    public function isReset(){
        return $this->reset;
    }

    public function getPage(){
        return $this->nextPage;
    }

    public function isValidName(){
        if($this->name == '' or $this->name === null){
            return false;
        }
        else{return true;}
    }

    private $nextPage = 'game.php';
    private $nurikabe;
    private $name;
    private $reset = false;
}