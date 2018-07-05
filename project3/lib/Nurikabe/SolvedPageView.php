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

    private $tableHTML;
    private $name;
}