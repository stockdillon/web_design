<?php


namespace Nurikabe;


class View
{
    function __construct()
    {

    }


    public function setTitle($title){
        $this->title = $title;
    }





    public function addLink($href, $text){
        $this->linkList .= "<a href=$href>$text</a>";
        $this->linkList .= " ";
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
</head>
HTML;
        return $html;
    }





    public function header(){
        $html = '';
        $html .= <<<HTML
<header>
    <div class="pictures">
        <p><img src="nifty800.png" alt="Nifty"></p>
    </div>
    <div class="links">
        <nav>
            $this->linkList  
        </nav>
    </div>
    <h1>$this->title</h1>
</header>
HTML;
        return $html;
    }




    public function footer(){
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






    private $title = '';
    private $linkList = '';
}