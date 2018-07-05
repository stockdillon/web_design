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


class IndexPageView
{
    public function __construct(IndexPage $indexPage){
        $this->indexPage = $indexPage;
        $this->name = $indexPage->getName();
        $this->nameErrorString = '';
        if($this->indexPage->getNameError()){
            $this->nameErrorString = "You must enter a name!";
        }
    }

    public function presentHeader(){
        $html = '';
        $html .= <<<HTML
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
HTML;
        return $html;
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
                <p><input type="text" name="name" value="$this->name"></p>
                <p><select name="difficulty"><option>3x3 Ultra Easy</option>
                <option>8x8 Very Easy</option>
                <option>10x10 Easy</option>
                <option>8x8 Medium</option>
                </select></p>
                <p><input type="submit" name="submit" value ="Start Game"></p>
            </form>
            <p>$this->nameErrorString</p>
        </div>
    </div>
</div>
HTML;
        return $html;
    }


    public function presentFooter(){
        $html = '';
        $html .= <<<HTML
<footer>
<div class="pictures">
<p><img src="nifty1-800.png" alt="Super Nifty"></p>
</div>
</footer>
HTML;
        return $html;
    }

    private $indexPage; // IndexPage object
    private $name;
    private $nameErrorString;
}