<?php
    session_start();
    $buttonArray = [];
    $mineArray = [];
    $buttonTextArray = [];
    $_SESSION['mineNr'] = 15;
    $_SESSION['buttons'] = $buttonArray;
    $_SESSION['mines'] = $mineArray;
    $_SESSION['buttontext'] = $buttonTextArray;
    $_SESSION['isfirstrun'] = true;
    

    for($i=0; $i<100; $i++) {
        $_SESSION['mines'][$i] = false;
        $_SESSION['buttons'][$i] = false;
        $_SESSION['buttontext'][$i] = ".";
    }

    for($i=0; $i<$_SESSION['mineNr']; $i++) {
        // még mindig nem jó, néha nem 15 akna van (pedig mindig egyedi számokat generál!!)
        $place = rand(0,99);
        if($_SESSION['mines'][$place] == false) {
            $_SESSION['mines'][$place] = true;
        }
        else {
            while($_SESSION['mines'][$place] == true) {
                $place = rand(0,99);
            }
            $_SESSION['mines'][$place] = true;
        }
        echo "$place\n";
    }
?>

<html>
    <head>
        <title>Valami</title>
        <link rel="stylesheet" href="stilus.css">
    </head>
    <body>
        <div class="buttons">
            <?php 
                for($i=0; $i<100; $i++) {
                    $text = $_SESSION['buttontext'][$i];
                    echo "<a href=\"welcome.php?button=$i\" class=\"activebutton\">$text</a>";
                    if(($i+1) % 10 == 0) {
                        echo "<br>";
                    }
                }
            ?>
        </div>
    </body>

</html>
