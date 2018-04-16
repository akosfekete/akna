<?php
    session_start();
    if(isset($_SESSION['felhasznalonev'])) {
        header("Location: profil.php");
        die();
    }
    include("beolvaso.php");
    $error = null;
    $message = null;
    if(isset($_POST["felhasznalonev"]) && isset($_POST["jelszo"]) && isset($_POST["email"])) {
        $felhasznalo_file = fopen("felhasznalok.csv", "r+");
        $felhasznalok = [];
        $emailek = [];
        //$i=0;
        $asor = fgets($felhasznalo_file);
        while(!feof($felhasznalo_file)) {
            array_push($emailek, explode(',',$asor)[0]);
            $asor = fgets($felhasznalo_file);
        }
        rewind($felhasznalo_file);
        while(!feof($felhasznalo_file)) {
            $asor = fgets($felhasznalo_file);
            if(count(explode(',',$asor)) == 1) {
                //fgets($felhasznalo_file);
                //echo "szar<br>";
                continue;    
            }
            //echo "nemszar<br>";
            array_push($felhasznalok, explode(',',$asor)[1]);
            
        }
        if(file_exists($_FILES["profilkep"]["tmp_name"])) {
            imageUpload($_POST['felhasznalonev']);
            echo "asdélksfdajélk <br>";
        }
     
        $uname = $_POST["felhasznalonev"];
        $email = $_POST["email"];
        $pass = $_POST["jelszo"];
        if($_POST["felhasznalonev"] != "" && $_POST["email"] != "" && $_POST["jelszo"] != "" && $_POST["jelszoism"] != "") {
            if(array_search($email, $emailek) != FALSE) {
                $error = "Már van ilyen e-mail cím.";
            }
            elseif($felhasznalok[array_search($uname, $felhasznalok)] == $uname) { // nem tudom ez mi a kurva anyjáért kell, de csak így működik.
                $error = "Már van ilyen nevű felhasználó."; // azért szar, mert 0 == FALSE. Az első elemnek placeholdernek kell lennie.
            }
            elseif($_POST["jelszoism"] != $pass) {
                $error = "A jelszavak nem egyeznek.";
            }
            elseif(!preg_match('/^[A-Z0-9._-]+@[A-Z0-9.-]+\.[A-Z0-9.-]+$/i', $email)) {
                $error = "Érvénytelen e-mail cím.";
            }
            elseif(!preg_match('/^[a-zA-Z0-9]+([_ -]?[a-zA-Z0-9])*$/', $uname)) {
                $error = "Érvénytelen felhasználónév."; //nem tartalmazhat szóközt, betűvel kell kezdődnie, - és _ megengedett, ha nem első karakter.
            }
            elseif(!preg_match('/^(?=.*\d).{4,16}$/', $pass)) {
                $error = "Érvénytelen jelszó."; // 4-16 karakter szükséges, melyek közül legalább 1 db szám.
            }
            else {
                $sor = [$_POST["email"], $_POST["felhasznalonev"], $_POST["jelszo"], $_POST["vezeteknev"], $_POST["keresztnev"], $_POST["nem"]];
                fputcsv($felhasznalo_file, $sor);
            }
        }
        else {
            $error = "valami üres.";
        }
        fclose($felhasznalo_file);
        if(is_null($error)) {
            header('refresh: 3 ; url = login.php');
            $message = "Sikeres regisztráció";
        }
    }
?>

<?php include("header.php"); ?>

                   <form action="reg.php" method="post" enctype="multipart/form-data">
                   <?php echo is_null($error) ? "" : "<label class=\"error\">Hiba: $error</label><br><br>"; ?>
                   <?php echo is_null($message) ? "" : "<label class=\"message\">Üzenet: $message</label><br><br>"; ?>
                    <label for="email" class="kotelezo">E-mail cím:</label> <br> <input type="text" name="email" placeholder="E-mail"> <br>
                    <label for="felhasznalonev" class="kotelezo">Felhasználónév:</label> <br> <input type="text" name=felhasznalonev placeholder="Felhasználónév"><br>
                    <label for="jelszo" class="kotelezo">Jelszó:</label> <br> <input type="password" name="jelszo" placeholder="Jelszó"> <br>
                    <label for="jelszoism" class="kotelezo">Jelszó mégegyszer:</label> <br> <input type="password" name="jelszoism" placeholder="Jelszó mégegyszer"> <br><br>
                    <label for="vezeteknev">Vezetéknév:</label> <br> <input type="text" name=vezeteknev placeholder="Vezetéknév"><br>
                    <label for="keresztnev">Keresztnév:</label> <br> <input type="text" name=keresztnev placeholder="Keresztnév"> <br>
                    <label for="nem">Nem:</label> <br>
                    <select name="nem" id="nem">
                        <option value="f">Férfi</option>
                        <option value="n">Nő</option>
                    </select> <br>
                    <label for="profilkep">Profilkép</label><br>
                    <input type="file" name="profilkep" id="profilkep"><br>        
                    <input type="submit">
                    <p>A <span class="kotelezo">pirossal</span> jelölt mezők kötelezőek.</p>
                   </form>
                   
<?php include("footer.php"); ?>