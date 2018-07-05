<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/9/17
 * Time: 12:19 AM
 */

namespace Nurikabe;


class NurikabeController
{
    public function __construct(Nurikabe $nurikabe, $post){
        $nurikabe->unsetSolved();
        $this->nurikabe = $nurikabe;
        if(isset($post['name'])){
            $name = strip_tags($post['name']);
            $name = ltrim($name);
            $name = rtrim($name);
            $this->name = $name;
            $this->nurikabe->setName($name);
            if($name == '' or $name === null){
                $this->validName = false;
            }
            $this->nurikabe->setGameActive();
        }
        else{$this->nurikabe->setNameError();}

        if(isset($post['difficulty'])){
            $difficulty = strip_tags($post['difficulty']);
            $this->difficulty = $difficulty;
            $this->nurikabe->setDifficulty($difficulty);
            if(strpos($this->difficulty, 'Ultra') !== false) {
                $key = '3x3';
                $this->nurikabe->setKey($key);
                $this->nurikabe->setTableSize(3);
                $this->nurikabe->setTable($key);
                $this->nurikabe->setSolvedTable($key);
            }
            elseif(strpos($this->difficulty, 'Very')){
                $key = '8x8easy';
                $this->nurikabe->setKey($key);
                $this->nurikabe->setTableSize(8);
                $this->nurikabe->setTable($key);
                $this->nurikabe->setSolvedTable($key);
            }
            elseif(strpos($this->difficulty, 'Medium')){
                $key = '8x8med';
                $this->nurikabe->setKey($key);
                $this->nurikabe->setTableSize(8);
                $this->nurikabe->setTable($key);
                $this->nurikabe->setSolvedTable($key);
            }
            else{
                $key = '10x10';
                $this->nurikabe->setKey($key);
                $this->nurikabe->setTableSize(10);
                $this->nurikabe->setTable($key);
                $this->nurikabe->setSolvedTable($key);
            }
        }




        if(isset($post['reset'])){
            $this->reset = true;
        }
    }

    public function isReset(){
        return $this->reset;
    }

    public function isValidName(){
        return $this->validName;
    }


    private $nurikabe;
    private $name;
    private $difficulty;
    private $reset = false;
    private $validName = true;
}