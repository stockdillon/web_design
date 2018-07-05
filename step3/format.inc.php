<?php
function present_header($title) {
    $html = <<<HTML
<header>
<nav><p><a href="welcome.php">New Game</a>
<a href="game.php">Game</a>
<a href="instructions.php">Instructions</a></p></nav>
<h1>$title</h1>
</header>
HTML;

    return $html;
}

$cave_pic = <<<PIC
<p class="cave">
<img src="cave.jpg" width="600" height="325" alt="Cave"/>
</p>
PIC;


function birds_adjacent($cave, $current_room){
    for($i=0; $i<=2; $i++){
        if($cave[$current_room][$i] == 7){return True;}
    }
    return False;
}


function pit_adjacent($cave, $current_room){
    for($i=0; $i<=2; $i++){
        if($cave[$current_room][$i] == 3){return True;}
        if($cave[$current_room][$i] == 10){return True;}
        if($cave[$current_room][$i] == 13){return True;}
    }
    return False;
}

/**
function wumpus_near($cave, $current_room){
    if(in_array(16, $cave[$current_room], True)){
        return True;
    }
    for($i=0; $i<=2; $i++){
        if(in_array(16, $cave[$cave[[$current_room][$i]]], True)){
            return True;
        }
    }
}
 */

function wumpus_adjacent($cave, $current_room){
    for($i=0; $i<=2; $i++){
        if($cave[$current_room][$i] == 16){return True;}
    }
    return False;
}

function wumpus_2steps($cave, $current_room){
    for($i=0; $i<=2; $i++){
        if($cave[$current_room][$i] == 16){
            return True;
        }
        $next_room = $cave[$current_room][$i];
        if(wumpus_adjacent($cave, $next_room) == True){
            return True;
        }
    }
    return false;
}