<?php
    session_start();

    $jmeno = "";
    $email = "";
    $heslo = "";
    $stav = "";
    $heslo_1 = "";
    $heslo_2 = "";
    $h_pivovar = "";
    $h_pivo = "";

    $errors = array();


    //connect to the database
    $db = mysqli_init();


    $db_address = 'localhost';
    $db_login = 'xkopac05';
    $db_password = 'r3nemhim';
    $db_database = 'xkopac05';
    if (!mysqli_real_connect($db, $db_address, $db_login, $db_password, $db_database, 0, '/var/run/mysql/mysql.sock')){
        die('cannot connect '.mysqli_connecterror());
    }
    mysqli_set_charset($db,"utf8");
    // if the register button is clicked
    if(isset($_POST['register'])){
        $jmeno = mysqli_real_escape_string($db, $_POST['jmeno']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $heslo_1 = mysqli_real_escape_string($db, $_POST['heslo_1']);
        $heslo_2 = mysqli_real_escape_string($db, $_POST['heslo_2']);
        
        // ensure that form fields are filled properly
        if(empty($jmeno)) {
            array_push($errors, "Je nutno zadat Jmeno"); 
        } else {
            $corjmeno = $jmeno;
        }
        $querytest = "SELECT * FROM bezny_uzivatel WHERE login='$corjmeno'";
        $result_test = mysqli_query($db, $querytest);
        if(mysqli_num_rows($result_test)) {
            array_push($errors, "Jmeno jiz existuje prosim zkuste jine"); 
        }        if(empty($email)) {
            array_push($errors, "Je nutno zadat Email"); 
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Chybna emailova adresa"); 
        }

        if(empty($heslo_1)) {
            array_push($errors, "Je nutno zadat Heslo"); 
        }
        if($heslo_1 != $heslo_2) {
            array_push($errors, "Hesla se neschoduji"); 
        }
        // if there are no errors, save user to database
        if(count($errors) == 0) {
            $heslo = $heslo_1;
            $sql = "INSERT INTO bezny_uzivatel (login, email, heslo)
                    Values ('$jmeno', '$email', '$heslo')";
            mysqli_query($db, $sql);
            $_SESSION['jmeno'] = $jmeno;
            $_SESSION['success'] = "Uzivatel: ";
            $_SESSION['hide'];
            header('location: /~xkopac05/IIS/index.php');
        }
    }

    // log user in from login page
    if (isset($_POST['login'])){
        $jmeno = mysqli_real_escape_string($db, $_POST['jmeno']);
        $heslo = mysqli_real_escape_string($db, $_POST['heslo']);

        if(empty($jmeno)) {
            array_push($errors, "Je nutno zadat Jmeno"); 
        }
        if(empty($heslo)) {
            array_push($errors, "Je nutno zadat Heslo"); 
        }
        if(count($errors) == 0) {
            $query = "SELECT * FROM bezny_uzivatel WHERE login='$jmeno' AND heslo='$heslo'";
            $result = mysqli_query($db, $query);

            $query = "SELECT * FROM sladek WHERE jmeno='$jmeno' AND heslo='$heslo'";
            $result_2 = mysqli_query($db, $query);

            if(mysqli_num_rows($result_2) == 1) {
                //log sladka
                $_SESSION['success'] = 'Sladek: ';
                $_SESSION['jmeno'] = $jmeno;
                $_SESSION['show'] = 'neco';
                header('location: /~xkopac05/IIS/index.php');
            } else if(mysqli_num_rows($result) == 1) {
                //log uzivatele
                $_SESSION['success'] = 'Uzivatel: ';
                $_SESSION['jmeno'] = $jmeno;
                header('location: /~xkopac05/IIS/index.php');
            } else {
                array_push($errors, "ERROR chybne udaje");
            }
        }
    }

    if(isset($_GET["id"])){
        $fk_pivovaru = $_GET["id"];
    }

    if (isset($_POST['Reg_piva'])){
        $nazev = mysqli_real_escape_string($db, $_POST['nazev']);
        $barva = mysqli_real_escape_string($db, $_POST['barva']);
        $kvaseni = mysqli_real_escape_string($db, $_POST['styl_kvaseni']);
        $typ = mysqli_real_escape_string($db, $_POST['typ']);
        $alkohol = mysqli_real_escape_string($db, $_POST['obsah_alkoholu']);
        if(empty($nazev)) {
            array_push($errors, "Je nutno zadat nazev"); 
        }
        if(empty($barva)) {
            array_push($errors, "Je nutno zadat barva"); 
        }
        else if(!is_numeric($barva)) {
            array_push($errors, "Je nutno zadat CISLO barvy");
        }
        if(empty($kvaseni)) {
            array_push($errors, "Je nutno zadat kvaseni"); 
        }
        if(empty($typ)) {
            array_push($errors, "Je nutno zadat typ"); 
        }
        if(empty($alkohol)) {
            array_push($errors, "Je nutno zadat alkohol"); 
        }
        else if(!is_numeric($alkohol)) {
            array_push($errors, "Je nutno zadat CELE CISLO procent alkoholu");
        }
        if(count($errors) == 0) {
            $sql = "INSERT INTO pivo (fk_pivovar, nazev, barva, styl_kvaseni, typ, obsah_alkoholu)
                    Values ( $fk_pivovaru, '$nazev', $barva, '$kvaseni', '$typ', $alkohol)";
            mysqli_query($db, $sql);
	    header('location: /~xkopac05/IIS/app/Pivo.php');
        }
    }

    //logout
    if (isset($_POST['logout'])){
        unset($_SESSION['show']);
        unset($_SESSION['jmeno']);
        unset($_SESSION['success']);
        session_destroy();
        header('location: /~xkopac05/IIS/index.php');
    }
?>

