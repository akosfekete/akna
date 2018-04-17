        <div class="box" id="box2">
            <form action="profil.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="foo" value="<?php echo $var;?>" />
                <label for="profilkep">Profilkép megváltoztatása</label>
                <input type="file" name="profilkep" id="profilkep"><br>
                <input type="submit" value="Mentés">
            </form>
        </div> 