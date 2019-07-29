<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registrace</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    
    <body>
            <div class="new_main">
                <div class="new_header">
                    <a href="/~xkopac05/IIS/index.php"><h4>Zpìt na úvodní stránku</h4></a>
                </div>
            
                <?php include('errors.php'); ?>

                <form  method="post">
                    <div class="kolonka">
                        <label>Jméno</label>
                        <input type="text" name="jmeno" placeholder="U&#382;ivatelské jmeno" value="<?php echo $jmeno; ?>">
                    </div>
                    <div class="kolonka">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Emailová adresa" value="<?php echo $email; ?>">
                    </div>
                    <div class="kolonka">
                        <label>Heslo</label>
                        <input type="password" name="heslo_1" placeholder="U&#382;ivatelské heslo">
                    </div>
                    <div class="kolonka">
                        <label>Potvrzení hesla</label>
                        <input type="password" name="heslo_2" placeholder="Zopakujte heslo">
                    </div>
                    <div class="kolonka">
                        <button type="submit" name="register" class='btn'>Registrovat</button>
                    </div>
                    <p>
                        Ji&#382; registrován? <a href="Prihlaseni.php">Pøihlásit</a>
                    </p>
                </form>
            </div>
    </body>
</html>