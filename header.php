<?php
    $page=0;

    switch($_SERVER['PHP_SELF']) {
        case '/akna/index.php' : 
            $page = 0;
            $title = "Főoldal";
            break;
        case '/akna/jatek.php' :
            $page = 1;
            $title = "Játék";
            break;
        case '/akna/akna.php' :
            $page = 1;
            $title = "Játék";
            break;
        case '/akna/leiras.php' :
            $page = 2;
            $title = "Leírás";
            break;
        case '/akna/toplista.php' :
            $page = 3;
            $title = "Toplista";
            break;
        case '/akna/reg.php' :
            $title = "Regisztráció";
            break;
        case "/akna/logout.php": 
            $title = "Kijelentkezve";
            break;
    }

?>

<html>
    <head>
        <title>Aknakereső | <?= $title ?></title>
        <link rel="stylesheet" href="css/stilus.css">
        <link rel="stylesheet" href="css/akna.css">
        <link rel="stylesheet" href="css/urlap.css">
        <link rel="stylesheet" href="css/tablazat.css">
    
    </head>

    <body>
        <div id="container">
            <header>
                <a href="./reg.php">Regisztráció</a> <a href="login.php">Belépés</a>
                <p>Aknakereső</p>
            </header>
            <nav>
                <ul>
                    <li><a href="./index.php" <?php echo $page == 0 ? "id=\"active\"" : "" ?>>Főoldal</a></li>
                    <li><a href="./jatek.php" <?php echo $page == 1 ? "id=\"active\"" : "" ?> >Játék</a></li>
                    <li><a href="./leiras.php"<?php echo $page == 2 ? "id=\"active\"" : "" ?> >Leírás</a></li>
                    <li><a href="./toplista.php"<?php echo $page == 3 ? "id=\"active\"" : "" ?> >Toplista</a></li>
                </ul>
            </nav>
            <main>