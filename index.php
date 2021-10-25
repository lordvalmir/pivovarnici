<?php include('app/server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pivovarnici</title>
	<meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="app/css/main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>

    <body>
        <div class="main">
            <div class="hlavicka">
                <div class="registrace">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="hide">
                    <?php endif ?>
                        <div class="button">
                            <a href="app/Prihlaseni.php">Přihlásit</a>
                        </div>
                        <div class="button">
                            <a href="app/Registrace.php">Registrovat</a>
                        </div>
                    <?php if (isset($_SESSION['success'])): ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($_SESSION['jmeno'])): ?>
                        <div class="prihlasen">
                            <?php 
                                echo $_SESSION['success'];
                                echo $_SESSION['jmeno'];
                            ?>
                        </div>

                    <form  method="post" action="index.php">
                        <div class="prihlasen">    
                            <button method="post"  name="logout">Logout</button>
                        </div>
                    </form>
                    <?php endif ?>
                </div>

                <div class="logo_menu">
                    <div class="logo">
                    </div>
                </div>

                <div class="titul">
                    <div class="line_1">
                        <div class="line_2">
                            <div class="nadpis">
                                <a href="index.php"><h1>Pivnice</h1></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uvod">
                <h2>Milovníci piva ví­tejte!</h2>
                <p> Nase stránky jsou určeny pro vsechny milovníky a znalce piv a stejně tak i pro vsechny sládky.
                    Na nasích stránkách si kazdý můze vyhledat to své pivo nebo svou oblíbenou pivnici.
                    Pro ty, kdo by rádi sdělili svůj názor na dané pivo nebo pivovar, prosíme o přihlásení.
                    Pokud nejste jen milovník piva, ale rovnou i sládek a rád byste se podělil o své recepty, prosím kontaktujte nás a my vám udělíme speciální účet.
                </p>
                <div class="vyhledavani">
                    <li><a href="app/Pivo.php">VYHLEDAT PIVO</a></li>
                    <li><a href="app/Pivovary.php">VYHLEDAT PIVOVAR</a></li>
                </div>
            </div>
            <hr>
            <div class="zajimavosti">
                <div class="col">
                    <h3>Ochutnávky piva</h3>
                    <img src="app/img/picture1.jpg">
                    <p>Ve světě existují tisíce druhů piv a vy ochutnáte to nejlepsí ze zemí jako je Belgie, Německo, ale i česká repubika. Průřez pivními styly a zeměmi v jednom. Degustace zahrnuje ochutnávku 6-8 vzorků piva.
                    </p>
                </div>
                
                <div class="col">
                    <h3>Na výlet za pivem!</h3>
                    <img src="app/img/picture2.jpg">
                    <p>Nejvýse polozený pivovar ve střední Evropě Luční bouda v Peci pod Snězkou bude 24. ledna místem konání jiz 9. ročníku konference Automatizace a modernizace pivovarů 2019.</p>
                </div>
                
                <div class="col">
                    <h3>Pivni slavnosti</h3>
                    <img src="app/img/picture3.jpg">
                    <p>Akce Pivní festival Brno opět na náměstí Svobody v Brně! Pivní festival Brno je festivalem předevsím chutí a zázitků. </p>
                </div>
                
                <div class="col">
                    <h3>Veletrh Piva</h3>
                    <img src="app/img/picture4.jpg">
                    <p>Ke konci září proběhl na návsi v plzeòských černicích jiz jedenáctý ročník známého pivního Veletrhu. My jsme na něm samozřejmě nechyběli, takze vám s mírným zpozděním přinásíme kratsí report.</p>
                </div>
            </div>
            <hr>
            <footer>
                <div class="last">
                    <div class="site">
                        <h3>JSME NA SITICH</h3>
                        <ul>
                            <li><a href="https://www.facebook.com">  <i class="fab fa-facebook">  </i></a></li>
                            <li><a href="https://www.instagram.com"> <i class="fab fa-instagram"> </i></a></li>
                            <li><a href="https://twitter.com">       <i class="fab fa-twitter">   </i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="last">
                    <h3>KONTAKT</h3>
                    <ul>
                        <p>Email:   JenPockej@zajici.ru </p>
                        <p>Telefón: 600 202 006         </p>
                    </ul>
                </div>
                <div class="last">
                    <h3>LOKALITA</h3>
                     <ul>
                        <p>Purkyòova 2640/93        </p>
                        <p>612 00 Brno-Královo Pole </p>
                    </ul>
                </div>
            </footer>
        </div>
    </body>
    
</html>
