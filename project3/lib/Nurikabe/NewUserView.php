<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/20/17
 * Time: 12:00 AM
 */

namespace Nurikabe;


class NewUserView extends View
{
    public function __construct($session, $get){
        $this->setTitle("Welcome to Dillon Stock's Nifty Nurikabe!");
        $this->addLink("instructions.php", "INSTRUCTIONS");


        if(isset($get['errname'])){
            $this->errorString = "You must supply a name.";
        }

        if(isset($get['erremail'])){
            $this->errorString = "You must supply an email address.";
        }

        if(isset($get['emailtaken'])){
            $this->errorString = "Email address already exists.";
        }

        if(isset($get['emailsent'])){
            $this->emailMessage = "An email message has been sent to your address. When it arrives, select the validate link
                                    in the email to validate your account";
            $this->hideDisplay = true;
        }
    }



    public function presentNewUserBody(){
        if($this->hideDisplay){
            return $this->theMessage();
        }

        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="green_box">
        <div class="text_box">
            <div class="small_green"><p>If you create an account on Nifty Nurikabe, you can save and load games as you play.</p></div>
            <div class="small_green"></div>
            <form method="post" action="http://webdev.cse.msu.edu/~stockdil/project2/newuser-post.php">
                <label for id="name">Name</label>
                <p><input type="text" id="name" name="name" value="$this->name"></p>
                <label for id="email">Email</label>
                <p><input type="text" id="email" name="email"></p>
                <p><input type="submit" id="create" name="create" value ="Create Account"></p>
                <p><input type="submit" id="cancel" name="cancel" value ="Cancel"></p>            
            </form>
            <div class="small_green"><p>$this->errorString</p></div>
        </div>
    </div>
</div>
HTML;
        return $html;
    }



    public function theMessage(){
        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="green_box">
        <div class="text_box">
            <div class="small_green"><p>$this->emailMessage</p></div>
            <form method="post" action="http://webdev.cse.msu.edu/~stockdil/project2/index.php">
                <p><input type="submit" id="home" name="home" value ="Home"></p>    
            </form>
        </div>
    </div>
</div>
HTML;
        return $html;
    }



    private $name;
    private $errorString = '';
    private $emailMessage = '';
    private $hideDisplay = false;
}