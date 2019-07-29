<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pivovary</title>
	<meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    </head>
    
    <body>
	<? header("Content-Type: text/html; charset=UTF-8");?>
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

                    <form  method="post" action="/~xkopac05/IIS/index.php">
                        <div class="prihlasen">    
                            <button method="post" name="logout">Logout</button>
                        </div>
                    </form>
                    <?php endif ?>
                </div>

                <div class="logo_menu">
                    <div class="logo"></div>
                </div>

                <div class="titul">
                    <div class="line_1">
                        <div class="line_2">
                            <div class="nadpis">
                                <a href="/~xkopac05/IIS/index.php"><h1>Pivnice</h1></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vyhledavani">
                <form method="post">
                    <p>Vyhledani pivovaru</p>
                    <input type="text" name="pivova" placeholder="Vyber pivovar">
                    <button type="submit" name="hledani">Vyhledat</button>
                </form>
            </div>

            <?php 
                if(isset($_POST ['pivova'])){
                    $h_pivovar = $_POST['pivova'];
                }
                $per_page = 6;

                $pivovar = "Select * FROM pivovar WHERE znacka LIKE '$h_pivovar%' ";
                $result_2 = mysqli_query($db, $pivovar);
                $count_2 = mysqli_num_rows($result_2);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $beer_per_page = ceil($count_2/$per_page);

                $print = ($page-1)*$per_page;

                $pivovar = "Select * FROM pivovar WHERE lower(znacka) LIKE '%$h_pivovar%' LIMIT " . $print . ',' . $per_page;

                $result_2 = mysqli_query($db, $pivovar);

                $datas_2 = array();
                if(mysqli_num_rows($result_2) > 0) {
                    while($row_2 = mysqli_fetch_assoc($result_2)){
                        $datas_2[] = $row_2;
                    }
                }
            ?>


            <div class="vypis">
                <?php foreach ($datas_2 as $data_2): ?>
                    <div class="pivo">
                        <p><b>Nazev pivovaru:</b>&nbsp;&nbsp; <?php echo $data_2['znacka']; ?> </p>
                        <p><b>Rok zalozeni:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $data_2['rok_zalozeni']; ?> </p>
                        <?php if (isset($_SESSION['jmeno'])): ?>
                        <p><b>Hodnoceni:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                            $id = $data_2['id_pivovar'];
                            $hodn = "SELECT AVG(rating) FROM pivovar_hodnoceni WHERE fk_pivovaru = $id";
                            $re = mysqli_query($db, $hodn);
                            while ($row = mysqli_fetch_assoc($re)) {
                                echo round($row['AVG(rating)']);
                            }
                        ?>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php foreach(range(1,5) as $rating): ?>
                            <a href="rate.php?pivovar=<?php echo $data_2['id_pivovar'];?>&rating=<?php echo $rating; ?>">
                                <?php echo $rating; ?>
                            </b></a>
                        <?php endforeach; ?>
                            </p>
                        <?php endif ?>
                        <?php if (!(isset($_SESSION['show']))): ?>
                            <div class="hide">
                        <?php endif ?>
                            <p>
                                <button type="submit" class='btn'>
                                    <a href=<?php echo "\"Reg_Pivo.php?id=".$data_2['id_pivovar']."\""; ?>> Pridat pivo </a> 
                                </button>
                             </p>
                        <?php if (!(isset($_SESSION['show']))): ?>
                            </div>
                        <?php endif ?>
                    </div>
                 <?php endforeach; ?>
            </div>

            <div class="strankovani">
                <?php 
                    for ($page=1; $page<=$beer_per_page; $page++) {
                        echo '<a href="Pivovary.php?page= ' . $page . '">' . $page," " . '</a>';
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
                        <p>Telefon:600 202 006         </p>
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