<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/7/17
 * Time: 10:18 PM
 */

namespace Nurikabe;


class IndexPage
{
    public function __construct(Nurikabe $nurikabe){
        $this->nurikabe = $nurikabe;
        $this->nameError = $this->nurikabe->getNameError();
    }

    public function getName(){
        $this->name = $this->nurikabe->getName();
        return $this->name;
    }

    public function getNameError(){
        return $this->nameError;
    }

    private $nurikabe;
    private $name;
    private $nameError;
}