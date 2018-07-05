<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/8/17
 * Time: 11:11 PM
 */

namespace Nurikabe;


class SolvedPageView
{
    public function __construct(SolvedPage $solvedPage){
        $this->solvedPage = $solvedPage;
        $this->name = $solvedPage->getName();
        $this->table = $solvedPage->getTable();
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
    <h1>Congratulations, $this->name, you solved Nifty Nurikabe!</h1>
</header>
HTML;
        return $html;
    }


    public function presentSolvedBody(){
        $tableHTML = $this->getTableHTML($this->table);
        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="solved_box">
<table>
$tableHTML
</table>
        <p>You're a winner!</p>
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


    public function getTableHTML(){
        $html = '';
        $rowNum = 0;
        foreach($this->table as $row){
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
                    $value = '&nbsp';
                }
                elseif($cell == Cell::ISLAND){
                    $class = 'island';
                    $value = '&#9679;';
                }
                if($cell == Cell::BLANK or $cell == Cell::SEA or $cell == Cell::ISLAND) {
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

    private $solvedPage;
    private $name;
}