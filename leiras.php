<?php include("header.php"); ?>

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
                        <li><img src="./img/gomb_aktiv.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
                        <li><img src="./img/gomb_aktiv.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
                        <li><img src="./img/gomb_aktiv.png" alt="Aktív állapot" width="30" height="30" class="gombkep"></li>
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
                            Az első kattintáskor (a játék indításakor) minden esetben aknamentes mezőt tárunk fel, a következő lépéstől kezdve 
                            azonban a feltáruló számok ismeretében, logikai úton, illetve időnként szerencsével tudunk továbbhaladni. A program 
                            folyamatosan jelzi a még megjelöletlen aknák számát, illetve az eltelt időt. A játék célja: teljesíteni a táblát a 
                            lehető legrövidebb idő alatt. Ha aknára kattintunk, az adott mező "felrobban", tehát a játék véget ér, s az adott 
                            menetet elvesztettük. Győzelemmel kizárólag abban az esetben fejeződik be a játék, ha felfedtünk minden olyan mezőt, 
                            amely alatt nincs akna. A győzelem elérése nem függ attól, hogy hány aknát jelöltünk meg zászlóval vagy kérdőjellel, 
                            illetve hogy használtuk-e egyáltalán ezeket a segítségeket.
                    </aside>
                    <aside id="video">
                        <video width="170" height="170" autoplay loop>
                            <source src="img/akna1.webm">
                        </video>
                    </aside>
                    
                </div> 
                <div class="leiras">
                    Majd ide jönnek a táblaméretek, a lehetséges beállítások. Az itteni megvalósítás működését is le kéne írni. Az előző leírás
                    sem jó.ek, a lehetséges beállek, a lehetséges beállek, a lehetséges beállek, a lehetséges beállek, a lehetséges beállek, a lehetséges beáll
                    ek, a lehetséges beállek, a lehetséges beállek, a lehetséges beáll
                </div>
                
            <?php include("footer.php"); ?>