<?php

    session_start();
    $_SESSION=$_POST['password'];
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP & MySQL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    
    <body>
        <h1>Titre principal</h1>
        <?php
            echo $_SESSION['password'];
        ?>
        <p>Un paragraphe</p>
    </body>
</html>