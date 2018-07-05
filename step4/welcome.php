<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
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
                <p><img src="cave-wumpus.jpg" alt="cave"></p>
            </div>
            <div class="custom"><p>Welcome to </p><div class="classy_font">Stalking the Wumpus</div></div>
        </div>
        <p><a href="instructions.php">Instructions</a></p>
        <p><a href="game.php">Start Game</a></p>
    </div>
</body>

</html>