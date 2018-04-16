<?php include_once($_SERVER['DOCUMENT_ROOT']."/constants.php"); ?>
<?php include_once(TEMPLATES_PATH."/header.php"); ?>
        
<?php
    if(isset($_SESSION['loggedin'])) {
        include(RESOURCES_PATH."/jatekform.php");
    }
    else {
        include(RESOURCES_PATH."/nemjogosult.php");
    }
?>
        
<?php include_once(TEMPLATES_PATH."/footer.php"); ?>