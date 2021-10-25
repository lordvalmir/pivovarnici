<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registrace piva</title>
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
                        <label>Nazev</label>
                        <input type="text" name="nazev" placeholder="Pilsner Urquell">
                    </div>
                    <div class="kolonka">
                        <label>Barva</label>
                        <input type="text" name="barva" placeholder="8 = barva se udava ve stupnici EBC">
                    </div>
                    <div class="kolonka">
                        <label>Typ kvaseni</label>
                        <input type="text" name="styl_kvaseni" placeholder="Spodne">
                    </div>
                    <div class="kolonka">
                        <label>Typ</label>
                        <input type="text" name="typ" placeholder="Svetly lezak">
                    </div>
                    <div class="kolonka">
                        <label>Obsah alkoholu</label>
                        <input type="text" name="obsah_alkoholu" placeholder="5">
                    </div>
                    <div class="kolonka">
                        <button type="submit" name="Reg_piva" class='btn'>Registrovat</button>
                    </div>
                </form>
            </div>
    </body>
</html>