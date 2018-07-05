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
        /*
         * For adding a record the "table_row" table... works... too late...
        $row['id'] = "1";
        $row['rownum'] = "2";
        $row['key'] = "3x3";
        $tableDB = new TableDatabase($site);
        $table_row = new TableRow($row);
        $tableDB->add($table_row);
        var_dump($table_row);
        $this->obj = $table_row;
        return;
        */


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

        /* GET THIS TO WORK, DO NOT THROW AWAY
        $tableCompare = new TableCompare($nurikabe->getTable(), $nurikabe->getKey());
        if($tableCompare->isTableSolved()){
            $this->redirect = 'solved.php';
        }
        */

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


        if(isset($post['load'])){
            $nurikabe->setTable($site->loadTable($key));
            //$this->redirect = "$root/game.php?load";
            return;
        }

        if(isset($post['save'])){
            //$site->saveTable($key, $nurikabe->getTable());
            //$this->redirect = "$root/game.php?save";

            return;
        }

    }

    public function isReset(){
        return $this->reset;
    }

    public function getRedirect(){
        return $this->redirect;
    }

    public function isValidName(){
        if($this->name == '' or $this->name === null){
            return false;
        }
        else{return true;}
    }

    private $redirect = 'game.php';
    //private $nurikabe;
    private $name;
    private $key;
    private $num;
    private $reset = false;
    public $obj;
}