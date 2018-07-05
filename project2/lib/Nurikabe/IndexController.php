<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 2:35 AM
 */

namespace Nurikabe;


class IndexController
{
    public function __construct($nurikabe, &$session, $post)
    {
        $this->nurikabe = $nurikabe;
        //$nurikabe->unsetSolved();
        if(isset($post['name'])){
            $name = strip_tags($post['name']);
            $name = ltrim($name);
            $name = rtrim($name);
            $this->name = $name;
            //$this->nurikabe->setName($name);
            if($name == '' or $name === null){
                $this->redirect = 'index.php?e';
            }
            //$this->nurikabe->setGameActive();
        }
        else{
            if(isset($session['user'])){
                $this->name = $session['user']->getName();
            }
            else {
                $this->redirect = 'index.php?e';
                return;
            }
        }

        if(isset($post['difficulty'])){
            $difficulty = $post['difficulty'];
            $getKey = new GetKey($difficulty);
            $this->key = $getKey->getKey();
        }


        if(!$nurikabe->isGameActive()){
            //$this->nurikabe = new Nurikabe($this->name, $this->key);
        }

        if(isset($post['reset'])){
            $this->reset = true;
        }

        $nurikabe = new Nurikabe($this->name, $this->key);
        $session[NURIKABE_SESSION] = $nurikabe;

    }


    public function isReset(){
        return $this->boolReset;
    }

    public function isValidName(){
        return $this->boolValidName;
    }

    public function getRedirect(){
        return $this->redirect;
    }


    private $boolReset = false;
    private $name;
    private $boolValidName = false;
    private $key;
    private $redirect = "game.php";
}