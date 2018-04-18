<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php");
    include_once(TEMPLATES_PATH."/header.php");  
    include_once(RESOURCES_PATH."/beolvaso.php"); 
?>
                <h1 style="margin-top: 10px;">TOP 10</h1>
                <table>
                    <thead>
                        <tr>
                            <th id="helyezes">Helyezés</th>
                            <th id="felhasznalonev">Felhasználónév</th>
                            <th id="pontszam">Pontszám</th>
                            <th id="idopont">Időpont</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach($toplista as $t) {
                        if($i > 10) {
                            break;
                        }
                        echo "<tr>\n";
                        echo "<td headers=\"helyezes\">$i.</td>\n";
                        echo "<td headers=\"felhasznalonev\"><a href=\"profil.php?felhasznalonev=$t[0]\">$t[0]</a></td>\n";
                        echo "<td headers=\"pontszam\">$t[1]</td>\n";
                        echo "<td headers=\"idopont\">$t[2]</td>\n";
                        echo "</tr>\n";
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
<?php include_once(TEMPLATES_PATH."/footer.php"); ?>