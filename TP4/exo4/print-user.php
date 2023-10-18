<?php
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
//echo('<pre>');
// print_r ($result);
// print_r($_POST);
// echo('</pre>');

if (count($result) > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Nom</th><th>Email</th></tr>';
    foreach ($result as $user) {
        echo '<tr>';
        echo '<td>' . $user->id . '</td>';
        echo '<td>' . $user->name . '</td>';
        echo '<td>' . $user->email . '</td>';
        echo '<td><form method="POST"><input type="hidden" name="id" value="'. $user->id.'"><input type="submit" name="action" class="btn-edit" value="Modifier"><input  name="action"  type="submit" class="btn-delete" value="Supprimer"></form>';
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