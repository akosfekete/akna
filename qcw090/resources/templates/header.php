<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $page=-1;
    $login = "<a href=\"login.php\">Belépés</a>";
    $reg = "<a href=\"./reg.php\">Regisztráció</a>";
    if(isset($_SESSION["felhasznalonev"])) {
        $login = "<a href=\"profil.php\">Profil</a>";
        $reg = "<a href=\"./logout.php\">Kilépés</a>";
    }

    $title = "";
    switch($_SERVER['PHP_SELF']) {
        case HTML_PATH."home.php" : 
            $page = 0;
            $title = "| Főoldal";
            break;
        case HTML_PATH."jatek.php"  :
            $page = 1;
            $title = "| Játék";
            break;
        case HTML_PATH."akna.php" :
            $page = 1;
            $title = "| Játék";
            break;
        case HTML_PATH."leiras.php"  :
            $page = 2;
            $title = "| Leírás";
            break;
        case HTML_PATH."toplista.php"  :
            $page = 3;
            $title = "| Toplista";
            break;
        case HTML_PATH."profil.php"  :
            $page = 4;
            $title = "| Profil";
            break;
        case HTML_PATH."reg.php"  :
            $title = "| Regisztráció";
            break;
        case HTML_PATH."logout.php" : 
            $title = "| Kijelentkezve";
            break;
        case HTML_PATH."login.php" :
            $title = "| Bejelentkezés";
            break;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aknakereső <?= $title ?></title>
        <link rel="stylesheet" href="css/stilus.css">
        <link rel="stylesheet" href="css/akna.css">
        <?php echo $page == 4 ? "" : "<link rel=\"stylesheet\" href=\"css/urlap.css\">"; ?>
        <link rel="stylesheet" href="css/tablazat.css">
        <?php echo $page == 4 ? "<link rel=\"stylesheet\" href=\"css/profil.css\">" : ""; ?>
    
    </head>

    <body>
        <div id="container">
            <header>
                <?= $reg ?> <?= $login ?>
                <p>Aknakereső</p>
            </header>
            <nav>
                <ul>
                    <li><a href="./home.php" <?php echo $page == 0 ? "id=\"active\"" : "" ?>>Főoldal</a></li>
                    <li><a href="./jatek.php" <?php echo $page == 1 ? "id=\"active\"" : "" ?> >Játék</a></li>
                    <li><a href="./leiras.php"<?php echo $page == 2 ? "id=\"active\"" : "" ?> >Leírás</a></li>
                    <li><a href="./toplista.php"<?php echo $page == 3 ? "id=\"active\"" : "" ?> >Toplista</a></li>
                </ul>
            </nav>
            <main>