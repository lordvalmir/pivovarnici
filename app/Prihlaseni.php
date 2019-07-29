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
                    <a href="/~xkopac05/IIS/index.php"><h4>Zp�t na �vodn� str�nku</h4></a>
                </div>

                <?php include('errors.php'); ?>

                <form  method="post">
                    <div class="kolonka">
                        <label>Jm�no</label>
                        <input type="text" name="jmeno" placeholder="Uzivatelsk� jm�no">
                    </div>
                    <div class="kolonka">
                        <label>Heslo</label>
                        <input type="password" name="heslo" placeholder="U&#382;ivat�lske heslo">
                    </div>
                    <div class="kolonka">
                        <button  type="submit" name="login" class='btn'>P�ihl�sit</button>
                    </div>
                    <p>
                        Jste registrov�n? <a href="Registrace.php">Registrovat</a>
                    </p>
                </form>

            </div>
        </div>
    </body>
    
</html>