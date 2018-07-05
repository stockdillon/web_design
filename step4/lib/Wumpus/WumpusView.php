<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 5/29/17
 * Time: 7:51 PM
 */

namespace Wumpus;


class WumpusView
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     */
    public function __construct(Wumpus $wumpus) {
        $this->wumpus = $wumpus;
    }

    /** Generate the HTML for the number of arrows remaining */
    public function presentArrows() {
        $a = $this->wumpus->numArrows();
        return "<p>You have $a arrows remaining.</p>";
    }

    public function presentStatus(){
        $result = "";
        $result .= '<p>' . date("g:ia l, F j, Y") . '</p>';
        $result .= '<p>&nbsp;</p>';
        $room_num = $this->wumpus->getCurrent()->getNum();
        //$room_num = 5;
        $result .= "<p>You are in room $room_num</p>";
        if($this->wumpus->hearBirds()){
            $result .= '<p>You hear birds!</p>';
        }
        else{
            $result .= '<p>&nbsp;</p>';
        }

        if($this->wumpus->feelDraft()) {
            $result .= '<p>You feel a draft!</p>';
        }
        else{
            $result .= '<p>&nbsp;</p>';
        }

        if($this->wumpus->smellWumpus()){
            $result .= '<p>You smell a wumpus!</p>';
        }
        else{
            $result .= '<p>&nbsp;</p>';
        }

        //if($this->wumpus->getCurrent()->contains(self::Birds, 0)){
        if($this->wumpus->wasCarried()){
            $room = $this->wumpus->getCurrent()->getNum();
            $result .= "You were carried by the birds to room $room!";
        }
        return $result;
    }

    /** Present the links for a room
     * @param $ndx An index 0 to 2 for the three rooms */
    public function presentRoom($ndx) {
        $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];
        $roomnum = $room->getNum();
        $roomndx = $room->getNdx();
        $roomurl = "game-post.php?m=$roomndx";
        $shooturl = "game-post.php?s=$roomndx";

        $html = <<<HTML
<div class="room">
  <figure><img src="cave2.jpg" width="180" height="135" alt=""/></figure>
  <p><a href="$roomurl">$roomnum</a></p>
<p><a href="$shooturl">Shoot Arrow</a></p>
</div>
HTML;

        return $html;
    }
}