<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php");
    require_once(RESOURCES_PATH."/functions.php");
    $error = null;
    if(isset($_POST["kep"])) {
        if(file_exists($_FILES["profilkep"]["tmp_name"])) {
            $error = imageUpload($_SESSION['felhasznalonev']);
            if($error == null) {
                header("Location: profil.php");
            }
        }
    }
    include_once(TEMPLATES_PATH."/header.php");  
    require_once(RESOURCES_PATH."/beolvaso.php"); 
?>
    <div class="profil">
        <h1><?= $felhasznalo[1] ?> profilja</h1>
        <div class="box" id="box1">
            <img src=<?= $profilkep ?> alt="user" width="170" height="170"><br>
            <div class="box" id="spanbox">
                <span>E-mailcím: <?php echo "$felhasznalo[0]" ?> </span><br>
                <span>Felhasználónév: <?= $felhasznalo[1] ?> </span><br>
                <span>Név: <?= $felhasznalo[3] == "" ? "Nincs megadva" : $felhasznalo[3]." ".$felhasznalo[4] ?> </span><br>
                <span>Nem: <?php echo $felhasznalo[5] == "f" ? "Férfi" : "Nő"; ?></span><br>
                <span>Legnagyobb pontszám: <?= $pontszam ?></span>
            </div>
        </div>
    <?php 
        if(isset($_SESSION['felhasznalonev']) && !isset($_GET['felhasznalonev'])) {
            include(RESOURCES_PATH."/profil_loggedin.php"); 
        }
    ?>
    </div>

<?php include_once(TEMPLATES_PATH."/footer.php"); ?>