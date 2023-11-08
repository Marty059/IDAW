<?php

    session_start();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP & MySQL</title>
        <meta charset="utf-8">
    </head>
    <?php
    
    ?>
    <body>
        <h1>Titre principal</h1>
        <?php
            echo $_SESSION['password'];
            echo $_SESSION['login'];
        ?>
    <form method="post" action="end_session.php">
        <button type="submit" name="deconnexion">deconnexion</button>
    </form>
    </body>
</html>