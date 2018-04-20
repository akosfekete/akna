<?php 
     function imageUpload($uname) {
        $target_dir = "profilkepek/";
        $target_file = $target_dir . basename($_FILES["profilkep"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $existing_file = glob("profilkepek/$uname.*");
        $error = "nincs error";

        if (file_exists($target_file)) {
            $error = "Már van ilyen fájl.";
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $error = "Csak JPG, JPEG, PNG és GIF kiterjesztésű fájlok megengedettek.";
        }
        else {
            if($existing_file) {
                unlink(realpath($existing_file[0]));
            }
            if(isset($_POST["felhasznalonev"])) {
                $target_file = $target_dir . $_POST["felhasznalonev"];
            }
            else {
                $target_file = $target_dir . $_SESSION['felhasznalonev'];
            }
            
            if (move_uploaded_file($_FILES["profilkep"]["tmp_name"], $target_file . '.' . $imageFileType)) {
                $error = null;
            } 
            else {
                $error = "hiba a képfeltöltésnél";
            }
        }
        return $error;
    }

    function getMineNumber($nehezseg) {
        if(isset($_SESSION['mezomeret'])) {
            $meret = $_SESSION['mezomeret'];
            $nehezseg;
            switch ($meret) {
                case 10 : return 10 + $nehezseg * 5;
                case 15 : return 20 + $nehezseg * 8;
                case 20 : return 30 + $nehezseg * 15;
            }
        }
    }

    function pontszamKiiras($pontszam) {
        if(!file_exists(FILES_PATH."/pontok.csv")) {
            $pontfile = fopen(FILES_PATH."/pontok.csv", "a+");    
        }
        else {
            $pontfile = fopen(FILES_PATH."/pontok.csv", "r+");
        }
        $pontok = [];
        $idopont = date("Y.m.d");
        $hely = -1;
    
        if(filesize(FILES_PATH."/pontok.csv") > 0) {
            while(!feof($pontfile)) {
                array_push($pontok, fgetcsv($pontfile));
            }
            $i=0;
            foreach($pontok as $p) {
                if($p[0] == $_SESSION['felhasznalonev']) {
                    $hely = $i;
                }
                $i++;
            }

            if($hely == -1) {
                fputcsv($pontfile, [$_SESSION['felhasznalonev'], $pontszam, $idopont]);
            }
            elseif($pontok[$hely][1] < $pontszam) {
                fputcsv($pontfile, [$_SESSION['felhasznalonev'], $pontszam, $idopont]);
            }
            
        }
        else {
            $sor = [$_SESSION['felhasznalonev'], $pontszam, $idopont];
            fputcsv($pontfile, $sor);
        }
        fclose($pontfile);
    }

    function checkButtons($buttonToCheck) { 
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
                    if($_SESSION['aknak'][$n] == true) {
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
                        if($_SESSION['gombok'][$n] == false and ($n != $buttonToCheck)) {
                            $_SESSION['gombok'][$n] = true;
                            $_SESSION['megnyomottgombok']++;
                            checkButtons($n);
                        }
                    }
                }
            }
        }
        if($m > 0) {
            $_SESSION['gombszoveg'][$buttonToCheck] = $m;            
        }
    }
?>