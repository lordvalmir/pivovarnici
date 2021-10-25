<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pivo</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
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
                            <a href="Prihlaseni.php">Prihlasit</a>
                        </div>
                        <div class="button">
                            <a href="Registrace.php">Registrovat</a>
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

                    <form  method="post" action="/">
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
                                <a href="/"><h1>Pivnice</h1></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vyhledavani">
                <form method="post">
                    <p>Vyhledani piva</p>
                    <input type="text" name="pivov" placeholder="Vyber pivo">
                    <button type="submit" name="hledani">Vyhledat</button>
                </form>
            </div>

            <?php 
                if(isset($_POST ['pivov'])){
                    $h_pivo = $_POST['pivov'];
                }
                $per_page = 6;

                $pivo = "Select * FROM pivo WHERE nazev like '$h_pivo%' ";
                $result_1 = mysqli_query($db, $pivo);
                $count_1 = mysqli_num_rows($result_1);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $beer_per_page = ceil($count_1/$per_page);

                $print = ($page-1)*$per_page;

                $pivo = "Select * FROM pivo WHERE lower(nazev) LIKE '%$h_pivo%' LIMIT " . $print . ',' . $per_page;
                $result_1 = mysqli_query($db, $pivo);

                $datas = array();
                if(mysqli_num_rows($result_1) > 0) {
                    while($row = mysqli_fetch_assoc($result_1)){
                        $datas[] = $row;
                    }
                }
            ?>

            <div class="vypis">
                <?php foreach ($datas as $data): ?>
                    <div class="pivo">
                        <p><b>Nazev piva:</b> <?php echo $data['nazev']; ?>          </p>
                        <p><b>Barva piva:</b> <?php echo $data['barva']; ?>          </p>
                        <p><b>Styl kvaseni:</b> <?php echo $data['styl_kvaseni']; ?>   </p>
                        <p><b>Typ:</b> <?php echo $data['typ']; ?>            </p>
                        <p><b>Obsah alkoholu:</b> <?php echo $data['obsah_alkoholu']; ?> </p>
                        <?php if (isset($_SESSION['jmeno'])): ?>
                        <p><b>Hodnoceni:
                        <?php
                            $id = $data['id_pivo'];
                            $hodn = "SELECT AVG(rating) FROM pivo_hodnoceni WHERE fk_pivo = $id";
                            $re = mysqli_query($db, $hodn);
                            while ($row = mysqli_fetch_assoc($re)) {
                                echo round($row['AVG(rating)']);
                            }
                        ?>
                        
                        <?php foreach(range(1,5) as $rating): ?>
                            <a href="rate.php?pivo=<?php echo $data['id_pivo'];?>&rating=<?php echo $rating; ?>">
                                <?php echo $rating; ?>
                            </a>
                        <?php endforeach; ?>
                        </b></p>
                        <?php endif ?>
                    </div>
                 <?php endforeach; ?>
            </div>
            <div class="strankovani">
                <?php 
                    for ($page=1; $page<=$beer_per_page; $page++) {
                        echo `<a href='Pivo.php?page= ' . $page . '">' . $page," " . '</a>'`;
                    }
                ?>
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
                        <p>Telefon: 600 202 006         </p>
                    </ul>
                </div>
                <div class="last">
                    <h3>LOKALITA</h3>
                     <ul>
                        <p>Purkynova 2640/93        </p>
                        <p>612 00 Brno-Kralovo Pole </p>
                    </ul>
                </div>
            </footer>
        </div>
    </body>
    
</html>