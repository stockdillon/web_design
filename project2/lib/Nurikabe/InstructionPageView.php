<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/8/17
 * Time: 11:11 PM
 */

namespace Nurikabe;


class InstructionPageView extends View
{
    public function __construct($nurikabe){
        $this->returnPage = '';
        $this->returnLink = '';
        $this->setTitle("Nifty Nurikabe Instructions");
        $this->addLink("index.php", "NEW GAME");
        if($nurikabe->isSolved()){
            $this->addLink("solved.php", "RETURN TO GAME");    // these two should be conditional
        }
        else{
            $this->addLink("game.php", "RETURN TO GAME");   // these two should be conditional
        }
    }



    public function presentInstructionBody(){
        $html = '';
        $html .= <<<HTML
<div class="instruction_box">
    <div class="instructions">
            <p><img src="example1.png" alt="Example Game"></p>
        <div class="actual_instructions">
            <h2>Rules</h2>
            <p>
            The game of Nurikabe is played on a rectangular grid of cells. Some cells contain numbers. When the game begins, all cells, other than the numbered cells, are empty, which is indicated by a cell filled with white. Game play consists of setting each cell to either an island or the sea.

            Islands are indicated by either cells with a number in them or cells with a dot. Every island has exactly one numbered cell that indicates how many cells there are in that island. Cells in an island are all connected horizontally or vertically.
            </p>
            <p>
            The sea is colored blue. A cell that is set to be part of the sea is filled with blue. There are two rules about the:
            </p>
            <ol>
                <li>The sea is contiguous, meaning every sea cells is adjacent horizontally or vertically to another sea cell.</li>
                <li>No "pools" are allowed. A pool is a 2 by 2 area of sea.</li>
            </ol>

            <p>
            Nurikabe solutions are unique. There is only one possible solution to any given game.
            </p>

            <h2>How to Play</h2>
            <p>
            Game play proceeds by clicking on cells. Each click toggles a cell from empty to sea to island. For example, if an empty cell is clicked on, it becomes sea. If sea is clicked on, it becomes an island. If an island cell is clicked on, it becomes empty. Cells with numbers in them are automatically island cells and are not clickable at all.
            </p>

            <h2>Links</h2>
            <nav>
                <ul>
                    <li><a href="https://en.wikipedia.org/wiki/Nurikabe">Wikipedia page on Nurikabe</a></li>
                    <li><a href="http://dl.acm.org/citation.cfm?id=2362108">Computational Complexity of Nurikabe</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
HTML;
        return $html;
    }



    private $returnPage;
    private $returnLink;
}