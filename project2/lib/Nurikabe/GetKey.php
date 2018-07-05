<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 2:47 AM
 */

namespace Nurikabe;


class GetKey
{
    public function __construct($difficulty)
    {
        $difficulty = strip_tags($difficulty);
        if(strpos($difficulty, 'Ultra') !== false) {
            $this->key = '3x3';
        }
        elseif(strpos($difficulty, 'Very')){
            $this->key = '8x8easy';
        }
        elseif(strpos($difficulty, 'Medium')){
            $this->key = '8x8med';
        }
        else{
            $this->key = '10x10';
        }
    }


    public function getKey(){
        return $this->key;
    }

    private $key;
}