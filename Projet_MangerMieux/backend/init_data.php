<?php
require_once("init_pdo.php");
function nombre_table($pdo){
    $request = $pdo->prepare("SELECT COUNT(*) as total_tables
    FROM information_schema.tables
    WHERE table_schema = 'manger_mieux'");
    $request->execute();
    $resultat=$request->fetch(PDO::FETCH_OBJ);
    $count=$resultat->total_tables;
    return($count);
}
$nb_table = nombre_table($pdo);
if($nb_table==0){
    $sqlFile = 'backend/manger_mieux.sql';
    $sql = file_get_contents($sqlFile);
    $pdo->exec($sql);
}
?>
