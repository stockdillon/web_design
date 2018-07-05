<?php
require 'format.inc.php';
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
$room = 1;// The room we are in.
$birds = 7;  // Room with the birds
$wumpus_smell = array(6,7,8,9,15,17,18,19,20);
$wumpus_room = 16;

$cave = array();
for($i=0;$i<20;$i++){
    $cave[$i] = array(0,0,0);
}// Get the cave
if(isset($_GET['r']) && isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
}
if($room == 7){$room = 10;}

$pits = array(3, 10, 13);
if(in_array($room, $pits)){
    header("Location: lose.php");
    exit;
}

if($room == $wumpus_room){
    header("Location: lose.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
    <link href="step2_style.css" type="text/css" rel="stylesheet" />
</head>




<body>
    <div class="links">
        <nav>
            <?php echo present_header("Stalking the Wumpus"); ?>
        </nav>
    </div>
    <div class="main_box">
        <div class="box">
            <div class="pic_box">
            <?php echo $cave_pic;?>
            </div>

            <?php
            /**
            echo '<p>' . date("g:ia l, F j, Y") . '</p>';
            ?>
            <p>You are in room <?php echo $room; ?></p>
            <p>&nbsp;</p>
            <?php
            if(birds_adjacent($cave, $room)) {
                echo '<p>You hear the birds!</p>';
            }
            else{
                echo '<p>&nbsp;</p>';
            }

            if(pit_adjacent($cave, $room)) {
                echo '<p>You feel a draft!</p>';
            }
            else{
                echo '<p>&nbsp;</p>';
            }

            if(wumpus_2steps($cave, $room)){
                echo '<p>You smell a wumpus!</p>';
            }
            else{
                echo '<p>&nbsp;</p>';
            }
             */
            ?>
            <?php
            echo $view->presentStatus();
            ?>
            <p>&nbsp;</p>
        </div>


        <div class="rooms">
            <?php
            echo $view->presentRoom(0);
            echo $view->presentRoom(1);
            echo $view->presentRoom(2);
            ?>
        </div>

        <?php
        echo $view->presentArrows();
        ?>
    </div>
</body>

</html>