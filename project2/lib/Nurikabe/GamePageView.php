<?php

namespace Nurikabe;

class GamePageView extends View
{
    public function __construct(Nurikabe $nurikabe, Site $site, $get){
        $key = $nurikabe->getKey();
        if(isset($get['load'])){
            //$nurikabe->setTable($site->loadTable($key));
        }

        if(isset($get['save'])){
            //$site->saveTable($key, $nurikabe->getTable());
        }

        $this->name = $nurikabe->getName();
        $this->tableHTML = $nurikabe->getGameHTML();
        $this->addLink("index.php", "NEW GAME");
        $this->addLink("instructions.php", "INSTRUCTIONS");
        $this->setTitle("Greetings, $this->name, and welcome to Nifty Nurikabe!");
    }




    public function presentGameBody(){

        $content = <<<HTML
HTML;


        $html = '';
        $html .= <<<HTML
<div class="grey_box">
<div class="table_box">
<form method="post" action="game-post.php">
$content
<table>
$this->tableHTML
</table>
</form>
<div class="buttons">
<form method="post" action="game-post.php">
<p><input type="submit" name="check" id="check" value ="Check Solution"></p>
<p><input type="submit" name="solved" id="solved" value ="Solve"></p>
<p><input type="submit" name="clear" id="clear" value ="Clear"></p>
</form>
</div>
</div>
HTML;
        //<p>$solvedString</p>
$html .= <<<HTML
</div>
HTML;

        $content .= <<<HTML
<script>
$(document).ready(function() {
	new Game("form");
});
</script>
HTML;

        return $html;
    }



    private $name;
    private $tableHTML;
}