<?php
require_once("init_data.php");

switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':
        $request = $pdo->prepare("SELECT * FROM ALIMENTS");
        $request->execute();
        $resultat=$request->fetchall(PDO::FETCH_OBJ);
        exit(json_encode($resultat));        
}
?>