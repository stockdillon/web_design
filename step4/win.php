<?php
require 'format.inc.php';
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
            <p><img src="dead-wumpus.jpg" alt="cave"></p>
        </div>
        <p>You killed the Wumpus</p>
    </div>
    <p><a href="welcome.php">New Game</a></p>

</div>

</body>

</html>