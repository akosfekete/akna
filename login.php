<?php 
    session_start();

    const UNAME = "user";
    const PASS = "jelszo";

    $error = null;
    if(isset($_SESSION['uname'])) {
        $uname = $_SESSION['uname'];
    }
    elseif((isset($_POST['uname'])) && isset($_POST['pass'])) {
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];

        if (strlen($uname) == 0) {
            $error = "Üres felhasználónév";
        }
        elseif(strlen($pass) == 0) {
            $error = "Üres jelszó";
        }
        //ide kell a txt-ben tárolt usernevekkel összehasonlítás

        else {
            $_SESSION['uname'] = $uname;
        }
    }  


include("header.php");

if(isset($_SESSION['uname'])) {
    echo "<h5>Bejelentkezés</h5>\n";
    echo "<p>Név: $uname</p>\n";
    echo "<p><a href=\"logout.php\">Kijelentkezés</a></p>\n"; // kellene egy session változót módosítani, ami miatt a header-ben lesz logout is.
}
elseif(isset($_POST['submit']) && $error == null) {
    echo "<p>Név: $uname</p>\n";
    echo "<p>Jelszó: $pass</p>\n";
}
else {
    if($error != null) {
        echo "<p style=\"color: red;\">$error</p>\n";
    }
}
?>

    <form action="login.php" method="post">
        <label for="uname">Felhasználónév</label> <br>
        <input type="text" id="uname" placeholder="Felhasználónév" name="uname"> <br> 
        <label for="pass">Jelszó</label> <br>
        <input type="text" id="pass" placeholder="Jelszó" name="pass"> <br>
        <input type="submit">
    </form>

<?php include("footer.php"); ?>