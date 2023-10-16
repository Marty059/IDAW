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

    // Charger le contenu du fichier SQL
    $sql = file_get_contents('sql/create_db.sql');

    // Exécuter les requêtes SQL
    $result = $pdo->exec($sql);
    if($result===false)
        echo "erreur";
    else
        echo "ok";
    
    // echo"{$result}";

}
catch (PDOException $erreur) {
    echo 'Erreur : '.$erreur->getMessage();
}
