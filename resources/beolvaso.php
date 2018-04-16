<?php 
    $felhasznalo_file = fopen("felhasznalok.csv", "r");
    $pontfile = fopen("pontok.csv", "r");
    $adatok = [];
    $felhasznalo = [];
    $pontok = [];
    $toplista = [];
    $usernevek = ["placeholder"];
    $pontszam = 0; //"Még nem játszott";

    function imageUpload($uname) {
        $target_dir = "profilkepek/";
        $target_file = $target_dir . basename($_FILES["profilkep"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $existing_file = glob("profilkepek/$uname.*");
        if($existing_file) {
            unlink(realpath($existing_file[0]));
        }

        if (file_exists($target_file)) {
            $error = "Már van ilyen fájl.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $error = "Csak JPG, JPEG, PNG és GIF kiterjesztésű fájlok megengedettek.";
            $uploadOk = 0;
        }
        else {
            if(isset($_POST["felhasznalonev"])) {
                $target_file = $target_dir . $_POST["felhasznalonev"];
            }
            else {
                $target_file = $target_dir . $_SESSION["felhasznalonev"];
            }
            
            if (move_uploaded_file($_FILES["profilkep"]["tmp_name"], $target_file . '.' . $imageFileType)) {
                echo "The file ". basename( $_FILES["profilkep"]["name"]). " feltöltve.";
            } 
            else {
                $error = "hiba a képfeltöltésnél";
            }
        }
    }

    function topSort($toplista) {
        for($i = 0; $i<count($toplista); $i++) {
            for($j = $i; $j<count($toplista); $j++) {
                if($toplista[$j][1] > $toplista[$i][1]) {
                    $temp = $toplista[$j];
                    $toplista[$j] = $toplista[$i];
                    $toplista[$i] = $temp;
                }
            }
        }
        return $toplista;
    }

    function findUser($user_to_find, $adatok) {
        foreach($adatok as $a) {
            if(is_array($a) || is_object($a)) {
                foreach($a as $s) {
                    if($s == $user_to_find) {
                        $felhasznalo = $a;
                    }
                }
            }
        }
        return $felhasznalo;
    }

    function getPontszam($user_to_find, $pontok) {
        $pontszam = 0;
        foreach($pontok as $p) {
            if(is_array($p) || is_object($p)) {
                if($p[0] == $user_to_find) { //ennek így jónak kéne lennie, mert mindig az utolsóval felülírja (és az utolsó lesz a legnagyobb pontszám!)
                    $pontszam = $p[1];
                }
            }
        }
        return $pontszam;
    }

    while(!feof($felhasznalo_file)) {
        array_push($adatok, fgetcsv($felhasznalo_file));
    }
    while(!feof($pontfile)) {
        array_push($pontok, fgetcsv($pontfile));
    }
    $rpontok = array_reverse($pontok);

    if(isset($_SESSION['felhasznalonev'])) {
        if(isset($_GET['felhasznalonev'])) {
            $felhasznalo = findUser($_GET['felhasznalonev'], $adatok);
            $pontszam = getPontszam($_GET['felhasznalonev'], $pontok);
            $uname = $_GET["felhasznalonev"];
        }
        else {
            $felhasznalo = findUser($_SESSION['felhasznalonev'], $adatok);
            $pontszam = getPontszam($_SESSION['felhasznalonev'], $pontok);
            $uname = $_SESSION["felhasznalonev"];
        }
        
        $profilkep = "img/default_user.png";
        $profilkep = glob("profilkepek/$uname.*") == FALSE ? $profilkep : glob("profilkepek/$uname.*")[0];
    }
    elseif(isset($_GET['felhasznalonev'])) {
        $felhasznalo = findUser($_GET['felhasznalonev'], $adatok);
        $pontszam = getPontszam($_GET['felhasznalonev'], $pontok);

        $uname = $_GET["felhasznalonev"];
        $profilkep = "img/default_user.png";
        $profilkep = glob("profilkepek/$uname.*") == FALSE ? $profilkep : glob("profilkepek/$uname.*")[0];
    }

    foreach($rpontok as $p) {
        foreach($adatok as $a) {
            if($p[0] == $a[1] && !array_search($a[1], $usernevek) && $p[0] != "") {
                array_push($toplista, [$a[1], $p[1], $p[2]]);
                array_push($usernevek, $a[1]);
            }
        }
    }
    $toplista = topSort($toplista);
    
    

    fclose($felhasznalo_file);
    fclose($pontfile);
?>