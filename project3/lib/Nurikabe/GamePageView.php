<?php

namespace Nurikabe;

class GamePageView extends View
{
    public function __construct(Nurikabe $nurikabe, Site $site, $get){
        $key = $nurikabe->getKey();

        $this->name = $nurikabe->getName();
        $this->tableHTML = $nurikabe->getGameHTML();
        $this->addLink("index.php", "NEW GAME");
        $this->addLink("instructions.php", "INSTRUCTIONS");
        $this->setTitle("Greetings, $this->name, and welcome to Nifty Nurikabe!");
    }


    public function head(){
        $html = '';
        $html .= <<<HTML
<head>
    <meta charset="UTF-8">
    <title>Nifty Nurikabe</title>
    <link href="project2.css" type="text/css" rel="stylesheet" />
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="site.con.js"></script> 
    <script>
$(document).ready(function() {
    new Game(".table_box");
});
</script>
</head>
HTML;
        return $html;
    }




    public function presentGameBody(){

        $content = <<<HTML
HTML;


        $html = '';
        $html .= <<<HTML
<div class="grey_box">
<div class="table_box">
$content
<table>
$this->tableHTML
</table>
<div class="buttons">
<p><input type="submit" name="check" id="check" value ="Check Solution"></p>
<p><input type="submit" name="solved" id="solved" value ="Solve"></p>
<p><input type="submit" name="clear" id="clear" value ="Clear"></p>
<p id='message'></p> <br>
<p><input type="hidden" id="yes" value="Yes"></p>
<p><input type="hidden" id="no" value="No"></p>
</div>
</div>
HTML;
        //<p>$solvedString</p>
$html .= <<<HTML
</div>
HTML;


        return $html;
    }



    private $name;
    private $tableHTML;
    private $solvedTable;
    private $solvedTableJSON;
}