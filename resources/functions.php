<?php 
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
                $target_file = $target_dir . S_UNAME;
            }
            
            if (move_uploaded_file($_FILES["profilkep"]["tmp_name"], $target_file . '.' . $imageFileType)) {
                echo "The file ". basename( $_FILES["profilkep"]["name"]). " feltöltve.";
            } 
            else {
                $error = "hiba a képfeltöltésnél";
            }
        }
    }
?>