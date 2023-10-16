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

$connectionString = "mysql:host=". _MYSQL_HOST;

if(defined('_MYSQL_PORT'))
    $connectionString .= ";port=". _MYSQL_PORT;

$connectionString .= ";dbname=" . _MYSQL_DBNAME;
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

$pdo = NULL;
try {
    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $erreur) {
    echo 'Erreur : '.$erreur->getMessage();
}

$request = $pdo->prepare("select * from users");
$request->execute();
$result = $request->fetchAll(PDO::FETCH_OBJ);
echo('<pre>');
print_r ($result);
echo('</pre>');

if (count($result) > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nom</th><th>Email</th></tr>';
    foreach ($result as $user) {
        echo '<tr>';
        echo '<td>' . $user->id . '</td>';
        echo '<td>' . $user->name . '</td>';
        echo '<td>' . $user->email . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

// TODO: add your code here
// retrieve data from database using fetch(PDO::FETCH_OBJ) and
// display them in HTML array

/*** close the database connection ***/
$pdo = null;

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
$pdo = NULL;
try {
    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    // Préparer et exécuter la requête SQL
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "Utilisateur ajouté avec succès.";



}
catch (PDOException $erreur) {
    echo 'Erreur : '.$erreur->getMessage();
}

$pdo=null;

