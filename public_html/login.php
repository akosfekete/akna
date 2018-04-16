<?php 
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT']."/constants.php");
    $error = null;
    if(file_exists(FILES_PATH."/felhasznalok.csv")) {
        $felhasznalo_file = fopen(FILES_PATH."/felhasznalok.csv", "r");
        $felhasznalok = [];
        $jelszavak = [];
        while(!feof($felhasznalo_file)) {
            $sor = fgets($felhasznalo_file);
            if(count(explode(',',$sor)) > 1) {
                try {
                    array_push($felhasznalok, explode(',',$sor)[1]);
                }
                catch(Exception $e) {}
            }
        }
        rewind($felhasznalo_file);
        while(!feof($felhasznalo_file)) {
            $sor = fgets($felhasznalo_file);
            if(count(explode(',',$sor)) > 1) {
                array_push($jelszavak, explode(',',$sor)[2]);
            }
        }
    }
    if(file_exists(FILES_PATH."/felhasznalok.csv")) {
        if(isset($_SESSION['felhasznalonev'])) {
            $uname = $_SESSION['felhasznalonev'];
        }
        elseif((isset($_POST['felhasznalonev'])) && isset($_POST['jelszo'])) {
            $uname = $_POST['felhasznalonev'];
            $pass = $_POST['jelszo'];
    
            if (strlen($uname) == 0) {
                $error = "Üres felhasználónév";
            }
            elseif(strlen($pass) == 0) {
                $error = "Üres jelszó";
            }
            elseif($felhasznalok[array_search($uname, $felhasznalok)] != $uname) {
                $error = "Nincs ilyen felhasználó";
            }
            else {
                $sorszam = array_search($uname, $felhasznalok);
                if($pass != $jelszavak[$sorszam]) {
                    $error = "Nem megfelelő jelszó!";
                }
                else {
                    $_SESSION['felhasznalonev'] = $uname;
                }
            }
        }
    }
    elseif(isset($_POST['felhasznalonev'])) {
        $error = "Nincs ilyen felhasználó";
    }   
      

if(isset($_SESSION['felhasznalonev'])) {
    header("Location: profil.php");
    die();
}

include_once(TEMPLATES_PATH."/header.php");

if(isset($_SESSION['felhasznalonev'])) { // ez így nagyon ronda, át kell írni teljesen.
    echo "<h2>Bejelentkezés</h2>\n";
    echo "<p>Név: $uname</p>\n";
    echo "<p><a href=\"logout.php\">Kijelentkezés</a></p>\n"; // kellene egy session változót módosítani, ami miatt a header-ben lesz logout is.
}
?>

    <form action="login.php" method="post">
        <?php echo is_null($error) ? "" : "<label class=\"error\">Hiba: $error</label><br><br>"; ?>
        <label for="felhasznalonev">Felhasználónév</label> <br>
        <input type="text" id="felhasznalonev" placeholder="Felhasználónév" name="felhasznalonev"> <br> 
        <label for="jelszo">Jelszó</label> <br>
        <input type="password" id="jelszo" placeholder="Jelszó" name="jelszo"> <br>
        <input type="submit">
    </form>

<?php include_once(TEMPLATES_PATH."/footer.php"); ?>