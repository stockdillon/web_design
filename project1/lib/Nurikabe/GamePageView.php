<?php

namespace Nurikabe;
use Nurikabe\GamePage as GamePage;

class GamePageView
{
    public function __construct(GamePage $gamePage){
        $this->gamePage = $gamePage;
        $this->name = $gamePage->getName();
        $this->table = $this->gamePage->getTable();
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
            <a href="index.php">NEW GAME</a>
            <a href="instructions.php">INSTRUCTIONS</a>
        </nav>
    </div>
    <h1>Greetings, $this->name, and welcome to Nifty Nurikabe!</h1>
</header>
HTML;
        return $html;
    }


    public function presentGameBody(){
        $tableHTML = $this->getTableHTML();
        if($this->gamePage->getIsSolved()){
            $solvedString = "You're a winner!";
        }
        else{$solvedString = "";}

        $html = '';
        $html .= <<<HTML
<div class="grey_box">
<div class="table_box">
<form method="post" action="game-post.php">
<table>
$tableHTML
</table>
</form>
<div class="buttons">
<form method="post" action="game-post.php">
<p><input type="submit" name="check" value ="Check Solution"></p>
<p><input type="submit" name="solved" value ="Solve"></p>
<p><input type="submit" name="clear" value ="Clear"></p>
</form>
</div>
</div>
<p>$solvedString</p>
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


    public function getTableHTML(){
        $html = '';
        $rowNum = 0;
        $table = $this->gamePage->getTable();
        if($this->gamePage->getBoolCheck()){
            $table = $this->gamePage->getRedTable();
        }
        foreach($table as $row){
            $colNum = 0;
            $html .= '<tr>';
            foreach($row as $cell){
                $name = "$rowNum,$colNum";
                if($cell == Cell::BLANK){
                    $class = 'empty';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::SEA){
                    $class = 'blue_cell';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::ISLAND){
                    $class = 'island';
                    $value = '&#9679;';
                }
                elseif($cell == Cell::RED_BLANK){
                    $class = 'red_cell';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::RED_SEA){
                    $class = 'red_sea';
                    $value = '&nbsp;';
                }
                elseif($cell == Cell::RED_ISLAND){
                    $class = 'red_island';
                    $value = '&#9679;';
                }
                if($cell == Cell::BLANK or $cell == Cell::SEA or $cell == Cell::ISLAND or $cell == Cell::RED_BLANK or $cell == Cell::RED_ISLAND or $cell == Cell::RED_SEA) {
                    //$html .= "<td><div class=$class><input type='submit' name=$name value =$value></div></td>"; // change this to instead append the appropriate html and tags
                    $html .= "<td class='cell'><div class=$class><input type='submit' name=$name value =$value></div></td>"; // change this to instead append the appropriate html and tags

                }

                else{$html .= "<td><div class='locked'>$cell</div></td>";}
                $colNum++;
            }
            $html .= '</tr>';
            $rowNum++;
        }
        return $html;
    }

    public function getName(){
        return $this->name;
    }


    private $gamePage;
    private $name;
    private $table;
}