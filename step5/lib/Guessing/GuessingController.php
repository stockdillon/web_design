<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/3/17
 * Time: 3:51 PM
 */

namespace Guessing;


class GuessingController
{
    public function __construct(Guessing $guessing, $post) {
        $this->guessing = $guessing;
        if(isset($post['value'])){
            $value = strip_tags($post['value']);
            $this->guess($value);
        }
        if(isset($post['clear'])) {
            echo "RESET";
            $this->reset = true;
        }
    }

    public function guess($guess_num){
        $this->guessing->guess($guess_num);
    }

    public function getPage(){
        return $this->page;
    }

    public function isReset(){
        return $this->reset;
    }

    private $guessing;
    //private $page = 'guessing.php';
    private $reset = false;
}