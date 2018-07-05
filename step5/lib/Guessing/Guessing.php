<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/2/17
 * Time: 9:09 PM
 */

namespace Guessing;


class Guessing
{
    const MIN = 1;
    const MAX = 100;
    const INVALID = -1;
    const TOOLOW = 0;
    const CORRECT = 1;
    const TOOHIGH = 2;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    public function getNumGuesses(){
        return $this->numGuesses;
    }

    public function guess($guess_num){
        $this->currentGuess = $guess_num;
        if($this->check() != self::INVALID){
            $this->numGuesses++;
        }
    }

    public function check(){
        if($this->currentGuess < 1){
            return self::INVALID;
        }
        elseif($this->currentGuess > 100){
            return self::INVALID;
        }
        elseif($this->currentGuess < $this->getNumber()){
            return self::TOOLOW;
        }
        elseif($this->currentGuess > $this->getNumber()){
            return self::TOOHIGH;
        }
        else{
            return self::CORRECT;
        }
    }

    public function getGuess(){
        return $this->currentGuess;
    }

    private $number;
    private $numGuesses = 0;
    private $currentGuess = 1;

}