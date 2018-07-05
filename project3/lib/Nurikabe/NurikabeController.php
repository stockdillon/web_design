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
            $getKey = new GetKey();
            $this->key = $getKet->getKey();
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

    private $key;
    private $nurikabe;
    private $name;
    //private $difficulty;
    private $reset = false;
    private $validName = true;
}