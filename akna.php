<?php
    session_start();
    if($_SESSION['isfirstrun']) {
        $_SESSION['mineNr'] = getMineNumber();
        $_SESSION['mezomeret'] = $_GET['mezomeret'];

        $buttonArray = [];
        $mineArray = [];
        $buttonTextArray = [];

        /*Értéke true, ha az adott gomb inktív
        (meg lett nomyva vagy rekurzívan fel lett
        fedve) */
        $_SESSION['buttons'] = $buttonArray; 

        /*Értéke igaz, ha van akna az adott mezőn*/
        $_SESSION['mines'] = $mineArray;

        //A gombokon megjelenő szöveg (szám vagy '.')
        $_SESSION['buttontext'] = $buttonTextArray;

        //Növelve van, ha egy gombra kattintunk, vagy az rekurzívan felfedésre került
        $_SESSION['megnyomottgombok'] = 0;

        $_SESSION['lepesek'] = 0;

        //Összesen hény gomb van
        $_SESSION['meret'] = $_SESSION['mezomeret'] ** 2;

        $_SESSION['pontszam'] = 0;

        for($i=0; $i<$_SESSION['meret']; $i++) {
            $_SESSION['mines'][$i] = false;
            $_SESSION['buttons'][$i] = false;
            $_SESSION['buttontext'][$i] = ".";
        }
        
        //random elhelyezi az aknákat. biztosra megy, hogy nincs két ugyanolyan szám(akkor eggyel kevesebb akna lenne)
        for($i=0; $i<$_SESSION['mineNr']; $i++) { 
            $place = rand(0,$_SESSION['meret']-1);
            if($_SESSION['mines'][$place] == false) {
                $_SESSION['mines'][$place] = true;
            }
            else {
                while($_SESSION['mines'][$place] == true) {
                    $place = rand(0,$_SESSION['meret']-1);
                }
                $_SESSION['mines'][$place] = true;
            }
            //echo "$place\n";
        }
    }
    
    function getMineNumber() {
        $meret = $_SESSION['mezomeret'];
        $nehezseg = $_GET['nehezseg'];

        switch ($meret) {
            case 10 : return 10 + $nehezseg * 5;
            case 15 : return 20 + $nehezseg * 8;
            case 20 : return 30 + $nehezseg * 15;
        }
    }
        
?>

<?php include("header.php"); ?>

        <div class="buttons" id="mezo<?= $_SESSION['mezomeret'] ?>">
            <?php 
                if(!$_SESSION['isfirstrun'] && 
                    !$_SESSION['buttons'][intval($_GET['button'])]) {
                    $buttonPressed = intval($_GET["button"]);
                    $_SESSION['megnyomottgombok']++;
                    $_SESSION['lepesek']++;
                    $_SESSION['buttons'][$buttonPressed] = true;
                }

                $meret = $_SESSION['mezomeret'] ** 2; //erre már van session változó, azt kéne használni

                for($i=0; $i<$meret; $i++) {
                    $text = $_SESSION['buttontext'][$i];
                    $color = "black";

                    if($_SESSION['isfirstrun']) {
                        break;
                    }
                    if($_SESSION['mines'][$buttonPressed] == true) {
                        echo "<video width=\"300\" height=\"300\" autoplay loop> <source src=\"img/allah.webm\"> </video>";
                        break;
                    }
                    if($_SESSION['megnyomottgombok'] == $meret-$_SESSION['mineNr']) { 
                        switch($_SESSION['mezomeret']) {
                            case 10 : echo "<img src=\"./img/winner.png\" alt=\"you're winner\" height=\"300\" width=\"300\">"; break;
                            case 15 : echo "<img src=\"./img/winner.png\" alt=\"you're winner\" height=\"450\" width=\"450\">"; break;
                            case 20 : echo "<img src=\"./img/winner.png\" alt=\"you're winner\" height=\"600\" width=\"600\">"; break;
                        }
                        
                        break;
                        
                    }   
                                  
                    checkButtons($buttonPressed);

                    if($i == $buttonPressed) {
                        
                        $text = $_SESSION['buttontext'][$buttonPressed];
                        if($text == '.') {
                            echo "<a  class=\"pressedemptybutton\">$text</a>";
                        }
                        else {
                            echo "<a  class=\"pressedbutton color$text\">$text</a>";
                        }
                        

                        $_SESSION['buttons'][$i] = true;

                    }
                    elseif($_SESSION['buttons'][$i]) {
                        if($text == '.') {
                            echo "<a  class=\"pressedemptybutton\" >$text</a>";    
                        }
                        else {
                            echo "<a  class=\"pressedbutton color$text\" >$text</a>";
                        }
                    }
                    else {
                        if($_SESSION['mines'][$i]) {
                            echo "<a href=\"akna.php?button=$i\" class=\"minebutton\">$text</a>";
                        }
                        else{
                            echo "<a href=\"akna.php?button=$i\" class=\"activebutton\">$text</a>";    
                        }
                    }
                    if(($i+1) % $_SESSION['mezomeret'] == 0) {
                        echo "\n\n";
                    }
                }
                if($_SESSION['isfirstrun']) {
                    for($i=0; $i<$meret; $i++) {
                        echo "<a href=\"akna.php?button=$i\" class=\"activebutton\">$text</a>";
                        if(($i+1) % $_SESSION['mezomeret'] == 0) {
                            echo "\n";
                        }
                    }
                    $_SESSION['isfirstrun'] = false;
                    $_SESSION['lepesek']++;
                }
                //fclose($myFile);
                function checkButtons($buttonToCheck) { //ezt ki lehetne szedni a div-ből, így nincs értelme.
                    $m = 0;
                    $oldal = $_SESSION['mezomeret'];
                    for($i=-1; $i<2; $i++) {
                        for($j=-1; $j<2; $j++) {
                            $n = $buttonToCheck + $i*$oldal+$j;
                            if(($n>=0) ) {
                                if($n >= $oldal ** 2) {
                                    continue;
                                }
                                if(($buttonToCheck % $oldal == 0) and ($n % $oldal == ($oldal -1) )) {
                                    continue;
                                }
                                if(($buttonToCheck % $oldal == ($oldal -1) ) and ($n % $oldal == 0 )) {
                                    continue;
                                }
                                if($_SESSION['mines'][$n] == true) {
                                    $m++;
                                }
                            }
                        }
                    }
                    
                    if($m==0) {
                        for($i=-1; $i<2; $i++) {
                            for($j=-1; $j<2; $j++) {
                                $n = $buttonToCheck + $i*$oldal+$j;
                                if(($n>=0) ) {
                                    if($n >= $oldal ** 2) 
                                        continue;
                                    if(($buttonToCheck % $oldal == 0) and ($n % $oldal == ($oldal -1))) {
                                        continue;
                                    }
                                    if(($buttonToCheck % $oldal == ($oldal - 1) ) and ($n % $oldal == 0 )) {
                                        continue;
                                    }
                                    if($_SESSION['buttons'][$n] == false and ($n != $buttonToCheck)) {
                                        $_SESSION['buttons'][$n] = true;
                                        $_SESSION['megnyomottgombok']++;
                                        checkButtons($n);
                                    }
                                }
                            }
                        }
                    }
                    if($m > 0) {
                        $_SESSION['buttontext'][$buttonToCheck] = $m;            
                    }
                }
            ?>
           
        </div>
            <h5> Aktív: <?= $_SESSION['meret'] - $_SESSION['megnyomottgombok'] ?><br> </h5>
            <h5> Lépések: <?= $_SESSION['lepesek'] ?><br> </h5>
        <br>
    <?php include("footer.php"); ?>