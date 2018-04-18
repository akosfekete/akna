<?php include_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php"); ?>
<?php include_once(TEMPLATES_PATH."/header.php"); ?>
        
<?php
    if(isset($_SESSION['felhasznalonev'])) {
        include(RESOURCES_PATH."/jatekform.php");
    }
    else {
        include(RESOURCES_PATH."/nemjogosult.php");
    }
?>
        
<?php include_once(TEMPLATES_PATH."/footer.php"); ?>