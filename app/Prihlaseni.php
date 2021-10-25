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
                    <a href="/"><h4>Zpet na uvodni stranku</h4></a>
                </div>

                <?php include('errors.php'); ?>

                <form  method="post">
                    <div class="kolonka">
                        <label>Jmeno</label>
                        <input type="text" name="jmeno" placeholder="Uzivatelske jmeno">
                    </div>
                    <div class="kolonka">
                        <label>Heslo</label>
                        <input type="password" name="heslo" placeholder="Uzivatelske heslo">
                    </div>
                    <div class="kolonka">
                        <button  type="submit" name="login" class='btn'>Prihlasit</button>
                    </div>
                    <p>
                        Jste registrovan? <a href="Registrace.php">Registrovat</a>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>