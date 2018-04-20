<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php");
    require_once(RESOURCES_PATH."/functions.php");
    session_start();

    if(isset($_SESSION['isfirstrun']) and $_SESSION['isfirstrun']) {

        $_SESSION['mezomeret'] = $_GET['mezomeret'];
        $_SESSION['nehezseg'] = $_GET['nehezseg'];
        $_SESSION['cheat'] = $_GET['cheat'];

        $_SESSION['mineNr'] = getMineNumber($_SESSION['nehezseg']);

        /*Értéke true, ha az adott gomb inaktív
        (meg lett nomyva vagy rekurzívan fel lett
        fedve) */
        $_SESSION['gombok'] = [];

        //Értéke true, ha van akna az adott mezőn
        $_SESSION['aknak'] = [];

        //A gombokon megjelenő szöveg (szám vagy '.')
        $_SESSION['gombszoveg'] = [];

        //Növelve van, ha egy gombra kattintunk, vagy az rekurzívan felfedésre került
        $_SESSION['megnyomottgombok'] = 0;

        //A lépések(kattintások) száma
        $_SESSION['lepesek'] = 0;

        //Összesen hány gomb van
        $_SESSION['meret'] = $_SESSION['mezomeret'] ** 2;

        $_SESSION['pontszam'] = 0;

        for($i=0; $i<$_SESSION['meret']; $i++) {
            $_SESSION['aknak'][$i] = false;
            $_SESSION['gombok'][$i] = false;
            $_SESSION['gombszoveg'][$i] = ".";
        }
        
        /*Véletlenszerűen elhelyezi az aknákat. biztosra megy, hogy nincs
        két ugyanolyan szám*/
        for($i=0; $i<$_SESSION['mineNr']; $i++) { 
            $place = rand(0,$_SESSION['meret']-1);
            if($_SESSION['aknak'][$place] == false) {
                $_SESSION['aknak'][$place] = true;
            }
            else {
                while($_SESSION['aknak'][$place] == true) {
                    $place = rand(0,$_SESSION['meret']-1);
                }
                $_SESSION['aknak'][$place] = true;
            }
        }
    }
    else {
        if(!isset($_SESSION['gombok'])) {
            header("Location: jatek.php");
        }
    }
?>

<?php include_once(TEMPLATES_PATH."/header.php"); ?>

        <div class="buttons" id="mezo<?= $_SESSION['mezomeret'] ?>">
            <?php 
                if(!$_SESSION['isfirstrun'] && 
                    !$_SESSION['gombok'][intval($_GET['button'])]) {
                    $buttonPressed = intval($_GET["button"]);
                    $_SESSION['megnyomottgombok']++;
                    $_SESSION['lepesek']++;
                    $_SESSION['gombok'][$buttonPressed] = true;
                }
                else {
                    $buttonPressed = -1;
                }

                $meret = $_SESSION['meret'];

                for($i=0; $i<$meret; $i++) {
                    $text = $_SESSION['gombszoveg'][$i];
                    $color = "black";

                    if($_SESSION['isfirstrun']) {
                        break;
                    }
                    if($buttonPressed != -1 && $_SESSION['aknak'][$buttonPressed] == true) {
                        //echo "<video width=\"300\" height=\"300\" autoplay loop> <source src=\"img/allah.webm\"> </video>";
                        echo "<h1>Játék vége</h1>";
                        echo "<div class=\"fooldal\" id=\"gombok\"><a href=\"jatek.php\"
                            style=\"width: 100px; font-size: 15px;\">Új játék</a></div>";
                        break;
                    }
                    if($_SESSION['megnyomottgombok'] == $meret-$_SESSION['mineNr']) { 
                        switch($_SESSION['mezomeret']) {
                            case 10 : echo "<img src=\"./img/winner.png\" alt=\"you're winner\" height=\"300\" width=\"300\">"; break;
                            case 15 : echo "<img src=\"./img/winner.png\" alt=\"you're winner\" height=\"450\" width=\"450\">"; break;
                            case 20 : echo "<img src=\"./img/winner.png\" alt=\"you're winner\" height=\"600\" width=\"600\">"; break;
                        }
                        $_SESSION['pontszam'] = ($_SESSION['meret'] - $_SESSION['lepesek']) * ($_SESSION['nehezseg']+1);
                        pontszamKiiras($_SESSION['pontszam']);
                        break;
                        
                    }   
                    if($buttonPressed != -1) {
                        checkButtons($buttonPressed);
                    }              

                    if($i == $buttonPressed) {
                        $text = $_SESSION['gombszoveg'][$buttonPressed];
                        if($text == '.') {
                            echo "<a  class=\"pressedemptybutton\">$text</a>";
                        }
                        else {
                            echo "<a  class=\"pressedbutton color$text\">$text</a>";
                        }
                        $_SESSION['gombok'][$i] = true;
                    }

                    elseif($_SESSION['gombok'][$i]) {
                        if($text == '.') {
                            echo "<a  class=\"pressedemptybutton\" >$text</a>";    
                        }
                        else {
                            echo "<a  class=\"pressedbutton color$text\" >$text</a>";
                        }
                    }

                    else {
                        if($_SESSION['aknak'][$i]) {
                            echo $_SESSION['cheat'] == 1 ? "<a href=\"akna.php?button=$i\" class=\"minebutton\">$text</a>" : 
                                "<a href=\"akna.php?button=$i\" class=\"activebutton\">$text</a>";
                        }
                        else {
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
                
            ?>
           
        </div>
            <h5> Aktív: <?= $_SESSION['meret'] - $_SESSION['megnyomottgombok'] ?><br> </h5>
            <h5> Lépések: <?= $_SESSION['lepesek'] ?><br> </h5>
            <h1> <?php echo $_SESSION['pontszam'] == 0 ? "" : "Pontszám: ".$_SESSION['pontszam']; ?></h1>
        <br>
<?php include_once(TEMPLATES_PATH."/footer.php"); ?>