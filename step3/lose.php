<?php
require 'format.inc.php';
require 'wumpus.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>You Killed the Wumpus</title>
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
            <p><img src="wumpus-wins.jpg" alt="cave"></p>
        </div>
        <p>You died and the Wumpus ate your brain!</p>
    </div>
    <p><a href="welcome.php">New Game</a></p>

</div>

</body>

</html>