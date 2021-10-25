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
                    <a href="/"><h4>Zpet na uvodni stranku</h4></a>
                </div>
            
                <?php include('errors.php'); ?>

                <form  method="post">
                    <div class="kolonka">
                        <label>Jmeno</label>
                        <input type="text" name="jmeno" placeholder="Uzivatelske jmeno" value="<?php echo $jmeno; ?>">
                    </div>
                    <div class="kolonka">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Emailova adresa" value="<?php echo $email; ?>">
                    </div>
                    <div class="kolonka">
                        <label>Heslo</label>
                        <input type="password" name="heslo_1" placeholder="Uzivatelske heslo">
                    </div>
                    <div class="kolonka">
                        <label>Potvrzeni hesla</label>
                        <input type="password" name="heslo_2" placeholder="Zopakujte heslo">
                    </div>
                    <div class="kolonka">
                        <button type="submit" name="register" class='btn'>Registrovat</button>
                    </div>
                    <p>
                        Jiz registrovan? <a href="Prihlaseni.php">Prihlasit</a>
                    </p>
                </form>
            </div>
    </body>
</html>