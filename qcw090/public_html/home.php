<?php require_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php"); ?>
<?php include_once(TEMPLATES_PATH."/header.php"); ?>

                    <div class="fooldal" id="gombok">
                        <a href="jatek.php">játék</a>
                        <a href="leiras.php">leírás</a>
                        <a href="toplista.php">toplista</a>
                        <a href=<?php echo isset($_SESSION['felhasznalonev']) ? "\"profil.php\">profil" : "\"reg.php\">regisztráció" ?> </a>
                    </div>

                    <div class="fooldal">
                        Az aknakereső egy népszerű egyszemélyes logikai játék, amely szinte minden mai személyi számítógépen megtalálható. 
                        A játék első változatai a 80-as évek elején jelentek meg, ma ismert formájában 1990-ben, a Microsoft cég Windows Entertainment Pack 
                        nevű játékgyűjteményének részeként látott napvilágot. A játék (a pasziánsszal egyetemben) a Windows 3.1 kiadása óta 
                        része az operációs rendszernek, így felhasználók milliói játsszák rendszeresen. A legtöbb számítógépes játékkal 
                        ellentétben az aknakereső során a játékosnak sokkal inkább az eszére, semmint ügyességére kell hagyatkoznia. 
                        A játék elé egyszerű ahhoz, hogy könnyedén meg lehessen érteni a szabályokat, ugyanakkor elég komplex ahhoz, hogy
                        ne váljon gyorsan unalmassá. A későbbiekben látni fogjuk, hogy a játék még egy számítógép számára is kellően bonyolult, 
                        jelenleg nem ismert hatékony algoritmus, amely képes lenne hibátlanul megoldani minden aknakereső-táblát. <br>
                    </div>
                    
<?php include_once(TEMPLATES_PATH."/footer.php"); ?>