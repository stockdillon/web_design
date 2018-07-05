<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 12:00 AM
 */

namespace Nurikabe;


class ValidateView extends View
{
    public function __construct($session, $get){
        $this->setTitle("");

        if(isset($get['erremail'])){
            $this->errorString = "You must enter an email!";
        }

        if(isset($get['errpassword'])){
            $this->errorString = "You must enter a password!";
        }

        if(isset($get['nomatch'])){
            $this->errorString = "Your password entries did not match.";
        }

        if(isset($get['errvalidator'])){
            $this->errorString = "Invalid or unavailable validator.";
        }

        if(isset($get['v'])){
            $this->v = $get['v'];
        }
    }



    public function presentValidateBody(){
        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="green_box">
        <div class="text_box">
            <form method="post" action="validate-post.php?v=$this->v">
                <label for id="email">Email</label>
                <p><input type="text" id="email" name="email"></p>
                <label for id="password">Password</label>
                <p><input type="text" id="password" name="password"></p>
                <label for id="again">Password (again)</label>
                <p><input type="text" id="again" name="again"></p>
                <p><input type="submit" id="create" name="create" value ="Create Account"></p>
                <p><input type="submit" id="cancel" name="cancel" value ="Cancel"></p>    
                <p><input type="hidden" name="v" value="$this->v"></p>
            </form>
            <div class="small_green"><p>$this->errorString</p></div>
        </div>
    </div>
</div>
HTML;
        return $html;
    }



    private $errorString = '';
    private $v;
}