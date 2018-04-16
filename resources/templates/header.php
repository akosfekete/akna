<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/constants.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $page=-1;
    $login = "<a href=\"login.php\">Belépés</a>";
    $reg = "<a href=\"./reg.php\">Regisztráció</a>";
    if(isset($_SESSION["loggedin"])) {
        $login = "<a href=\"profil.php\">Profil</a>";
        $reg = "<a href=\"./logout.php\">Kilépés</a>";
    }

    $title = "";
    switch($_SERVER['PHP_SELF']) {
        case "/public_html/home.php" : 
            $page = 0;
            $title = "| Főoldal";
            break;
        case "/public_html/jatek.php"  :
            $page = 1;
            $title = "| Játék";
            break;
        case "/public_html/akna.php" :
            $page = 1;
            $title = "| Játék";
            break;
        case "/public_html/leiras.php"  :
            $page = 2;
            $title = "| Leírás";
            break;
        case "/public_html/toplista.php"  :
            $page = 3;
            $title = "| Toplista";
            break;
        case "/public_html/profil.php"  :
            $page = 4;
            $title = "| Profil";
            break;
        case "/public_html/reg.php"  :
            $title = "| Regisztráció";
            break;
        case "/public_html/logout.php" : 
            $title = "| Kijelentkezve";
            break;
        case "/public_html/login.php" :
            $title = "| Bejelentkezés";
            break;
    }
?>

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