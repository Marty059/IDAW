<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
</head>
<body>

<?php
require_once('config.php');
require_once('add.php');
require_once('print-user.php');
?>

<h2>Ajouter un utilisateur</h2>

    <form action="user.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Ajouter">
    </form>

</body>
</html>

<?php
