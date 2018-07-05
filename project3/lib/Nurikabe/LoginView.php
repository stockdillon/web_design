<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 12:00 AM
 */

namespace Nurikabe;


class LoginView extends View
{
    public function __construct($session, $get){
        $this->setTitle("");

        if(isset($get['erremail'])){
            $this->errorString = "You must enter an email!";
        }

        if(isset($get['errpassword'])){
            $this->errorString = "You must enter a password!";
        }

        if(isset($get['errcredentials'])){
            $this->errorString = "Invalid Login Credentials!";
        }
    }



    public function presentLoginBody(){
        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="green_box">
        <div class="text_box">
            <form method="post" action="login-post.php">
                <label for id="email">Email</label>
                <p><input type="text" id="email" name="email"></p>
                <label for id="password">Password</label>
                <p><input type="text" id="password" name="password"></p>
                <p><input type="submit" id="login" name="login" value ="Log In"></p>
                <p><input type="submit" id="cancel" name="cancel" value ="Cancel"></p>            
            </form>
            <div class="small_green"><p>$this->errorString</p></div>
        </div>
    </div>
</div>
HTML;
        return $html;
    }


    private $errorString = '';
}