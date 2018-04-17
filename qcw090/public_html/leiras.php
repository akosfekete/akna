<?php include_once($_SERVER['DOCUMENT_ROOT']."/constants.php"); ?>
<?php include_once(TEMPLATES_PATH."/header.php"); ?>

               <div class="leiras">
                    Az aknakereső egy számítógépes játék, melynek célja a mezőn lévő összes akna megtalálása, illetve azok elkerülése. 
                    Az aknakereső alapvetően logikai játék, de bármely játékmenetben előfordulhat olyan szituáció is, amelyben a helyes 
                    megoldás a szerencsén múlik. Egyszemélyes játék, de létezik kétszemélyes változata is, annak szabályai és stratégiái 
                    néhány ponton eltérnek az egyszemélyes verzióétól.
                </div>
                <div class="leiras">
                    A mezők állapotai a következők lehetnek: 
                    <ol>
                        <li>lefedett (alaphelyzet)</li>
                        <li>feltárt, szomszédos aknával</li>
                        <li>feltárt, aknamentes</li>
                        <li>feltárt, robbanó aknával</li>
                    </ol>
                    <ol id="kepek">
                        <li><img src="./img/gomb_aktiv.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
                        <li><img src="./img/gomb_felfedett_akna.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
                        <li><img src="./img/gomb_felfedett.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
                        <li><img src="./img/gomb_akna.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
                    </ol>                    
                    
                </div>
                <div class="leiras">
                    Egy mezőt feltárni kattintással lehet. Ha egy mező feltárult, és mellette akna található, akkor annak darabszámát 
                    egy számmal fogja jelezni (egy mező mellett értelemszerűen maximum 8 akna lehet). Ha a játékos aknamentes környezetű 
                    mezőre kattint, akkor az adott mezőhöz oldal- és sarokhatárosan csatlakozó (aknamentes) mezők mindegyike feltárul, 
                    valamint az így feltáruló aknamentes "szigettel" szomszédos mezők is feltárulnak.
                </div>
                <div class="leiras">
                    <aside id="videoleiras">
                            A játék során a kattintásokra feltáruló számok ismeretében, logikai úton, illetve időnként szerencsével tudunk továbbhaladni. A program 
                            folyamatosan jelzi a még megjelöletlen aknák, valamint a lépések (azaz kattintásook) számát. A játék célja: teljesíteni a táblát a 
                            lehető legrövidebb idő alatt. Ha aknára kattintunk, az adott mező "felrobban", tehát a játék véget ér, s az adott 
                            menetet elvesztettük. Győzelemmel kizárólag abban az esetben fejeződik be a játék, ha felfedtünk minden olyan mezőt, 
                            amely alatt nincs akna. A győzelem elérése nem függ attól, hogy hány aknát jelöltünk meg,  
                            illetve hogy használtuk-e egyáltalán ezt a segítséget.
                    </aside>
                    <aside id="video">
                        <video width="170" height="170" autoplay loop>
                            <source src="img/akna2.webm">
                        </video>
                    </aside>
                    
                </div> 
                <div class="leiras">
                    Az aknakereső pálya paraméterezése a "Játék" menüpont alól elérhető paraméterező űrlap segítségével valósítható meg. Három mező választható:
                    10x10, 15x15, illetve 20x20-as rács elrendezésben. Ezen felül a játék nehézsége is állítható 3 lépésben. 
                </div>
                
                
            <?php include_once(TEMPLATES_PATH."/footer.php"); ?>