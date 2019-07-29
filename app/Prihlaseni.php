<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pivo</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    
    <body>
        <?php if (isset($_SESSION['success'])): ?>
        <?php endif ?>
        <div class="main">
            <div class="new_main">
                <div class="new_header">
                    <a href="/~xkopac05/IIS/index.php"><h4>Zpìt na úvodní stránku</h4></a>
                </div>

                <?php include('errors.php'); ?>

                <form  method="post">
                    <div class="kolonka">
                        <label>Jméno</label>
                        <input type="text" name="jmeno" placeholder="Uzivatelské jméno">
                    </div>
                    <div class="kolonka">
                        <label>Heslo</label>
                        <input type="password" name="heslo" placeholder="U&#382;ivatélske heslo">
                    </div>
                    <div class="kolonka">
                        <button  type="submit" name="login" class='btn'>Pøihlásit</button>
                    </div>
                    <p>
                        Jste registrován? <a href="Registrace.php">Registrovat</a>
                    </p>
                </form>

            </div>
        </div>
    </body>
    
</html>