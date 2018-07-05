<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/8/17
 * Time: 11:11 PM
 */

namespace Nurikabe;


class SolvedPageView extends View
{
    public function __construct($nurikabe){
        $this->name = $nurikabe->getName();
        $this->tableHTML = $nurikabe->getSolvedHTML();
        $this->setTitle("Congratulations, $this->name, you solved Nifty Nurikabe!");
        $this->addLink("index.php", "NEW GAME");
        $this->addLink("instructions.php", "INSTRUCTIONS");
    }



    public function presentSolvedBody(){
        //$tableHTML = $this->getTableHTML($this->table);
        $html = '';
        $html .= <<<HTML
<div class="grey_box">
    <div class="solved_box">
<table>
$this->tableHTML
</table>
        <p>You're a winner!</p>
    </div>
</div>
HTML;
        return $html;
    }



/*
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
*/

/*
    public function getName(){
        return $this->name;
    }
*/

    private $tableHTML;
    private $name;
}