<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/7/17
 * Time: 10:03 PM
 */

namespace Nurikabe;



class IndexPageView extends View
{
    public function __construct(Site $site, $session, $get){
        $this->setTitle("Welcome to Dillon Stock's Nifty Nurikabe!");
        $this->addLink("instructions.php", "INSTRUCTIONS");

        if(isset($get['e'])){
            $this->errorMessage = '<p class="msg">You must enter a name!</p>';
        }

        //var_dump($session['name']);
        if(isset($session['name'])){
            //var_dump("set name to " .$session['name']);
            $this->name = $session['name'];
        }
        $this->nameForm = "<p><input type='text' name='name' value='".$this->name."'".$this->disabled."></p>";
    }


    public function presentIndexBody(){
        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="green_box">
        <div class="text_box">
            <div class="small_green">
                <p>Name</p>
            </div>
            <form method="post" action="index-post.php">
                $this->nameForm
                <p><select name="difficulty"><option>3x3 Ultra Easy</option>
                <option>8x8 Very Easy</option>
                <option>10x10 Easy</option>
                <option>8x8 Medium</option>
                </select></p>
                <p><input type="submit" name="submit" value ="Start Game"></p>
            </form>
            $this->errorMessage
        </div>
    </div>
</div>
HTML;
        return $html;
    }



    private $loginMessage = '';
    private $name = '';
    private $errorMessage = '';
    private $disabled = '';
}