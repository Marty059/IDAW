<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP2-PHP</title>
</head>

<body>
    La date d'aujourd'hui est le :
<?php
    // Définir le fuseau horaire
    date_default_timezone_set('Europe/Paris');

    // Obtenir l'heure actuelle au format souhaité
    $heure = date('H:i:s');

    // Affichage Date
    echo date("d/m/Y");
    echo "<br>";
    echo $heure;
?>

