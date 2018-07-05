<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/7/17
 * Time: 10:03 PM
 */

namespace Nurikabe;


/**
<header>
<div class="pictures">
<p><img src="nifty800.png" alt="Nifty"></p>
</div>
<div class="links">
<nav>
<a href="instructions.php">INSTRUCTIONS</a>
</nav>
</div>

<h1>Welcome to Dillon Stock's Nifty Nurikabe!</h1>
</header>

<div class="grey_box">
<div class="green_box">
<div class="text_box">
<div class="small_green">
<p>Name</p>
<div class="small_grey">
<p><input type="text" name="Dillon" value="Enter your name"></p>
</div>
<p><select><option>3x3 Ultra Easy</option>
<option>8x8 Very Easy</option>
<option>10x10 Easy</option>
<option>8x8 Medium</option>
</select></p>
<p><input type="submit" name="start" value ="Start Game"></p>
</div>
</div>
</div>
</div>

<footer>
<div class="pictures">
<p><img src="nifty1-800.png" alt="Super Nifty"></p>
</div>
</footer>
 */


class IndexPageView extends View
{
    public function __construct(Site $site, $session, $get){
        $this->setTitle("Welcome to Dillon Stock's Nifty Nurikabe!");
        $this->addLink("instructions.php", "INSTRUCTIONS");
        //if(isset($get['loginsuccess'])){
        if(isset($session['user'])){
            $this->loginMessage = "Login Successful.";
            $this->name = $session['user']->getName();
            $this->disabled = "disabled";
            $this->addLink("index-post.php?logout", "LOG OUT");
        }
        else {
            $this->addLink("login.php", "LOG IN");
            $this->addLink("newuser.php", "NEW USER");

        }
        if(isset($_GET['e'])){
            $this->errorMessage = '<p class="msg">You must enter a name!</p>';
        }

        $this->nameForm = "<p><input type='text' name='name' value='".$this->name."'".$this->disabled."></p>";

    }


    //<p><input type="text" name="name" value="$this->name" $this->disabled></p>


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
            <div class="small_green">$this->loginMessage</div>
            <div class="small_green">$this->errorMessage</div>
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