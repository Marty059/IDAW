<?php

    session_start();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP & MySQL</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <h1>Titre principal</h1>
        <?php
            echo $_SESSION['password'];
            echo $_SESSION['login'];
        ?>
        <p>Un paragraphe</p>
    </body>
</html>