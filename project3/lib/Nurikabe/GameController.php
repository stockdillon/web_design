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
    public function __construct(Site &$site, Nurikabe $nurikabe, $post, &$session){


        $key = $nurikabe->getKey();
        //$this->nurikabe = $nurikabe;
        $this->name = $nurikabe->getName();
        $this->num = 3;
        $root = $site->getRoot();
        if($key == '3x3'){$this->num=3;}
        if($key == '8x8easy'){$this->num=8;}
        if($key == '8x8med'){$this->num=8;}
        if($key == '10x10'){$this->num=10;}


        for($i = 0; $i<$this->num; $i++){
            for($j=0; $j<$this->num; $j++){
                if(isset($post["$i,$j"])){
                    $row = $i;
                    $col = $j;
                    $nurikabe->clickCell($i, $j);
                }
            }
        }

        if(isset($post['solved'])){
            $nurikabe->setSolved();
            $this->redirect = "solved.php";
        }

        if(isset($post['clear'])){
            $nurikabe->setTable($key);
        }

        if(isset($post['check'])){
            $this->redirect = "game.php?check";
            return;
            //$displayTable = new DisplayTable($nurikabe->getTable(), $nurikabe->getKey(), $nurikabe->getClickedCells);
            /*
            for($i = 0; $i<$this->num; $i++){
                for($j=0; $j<$this->num; $j++){
                    $this->nurikabe->checkCell($i, $j);
                }
            }
            */
        }

    }

    public function isReset(){
        return $this->reset;
    }

    public function getResult(){
        return $this->result;
    }


    private $name;
    private $num;
    private $result = 'fail';
    public $obj;
}