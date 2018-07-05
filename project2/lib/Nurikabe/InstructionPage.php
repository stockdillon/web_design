<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/8/17
 * Time: 11:11 PM
 */

namespace Nurikabe;


class InstructionPage
{
    public function __construct(Nurikabe $nurikabe){
        $this->nurikabe = $nurikabe;
        if($this->nurikabe->isGameActive()){
            $this->gameActive = true;
            if($this->nurikabe->isSolved()){
                $this->solved = true;
            }
        }
    }

    public function isSolved()
    {
        return $this->solved;
    }

    public function isGameActive(){
        return $this->gameActive;
    }


    private $nurikabe;
    private $solved = false;
    private $gameActive = false;
}