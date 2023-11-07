<?php 
require_once('init_pdo.php');
switch($_SERVER["REQUEST_METHOD"]){
    //donne nutriments d'un plat donné
    case 'GET':   
        $data_array = json_decode(file_get_contents('php://input'), true);
        $request = $pdo->prepare;
        $request->bindParam(":nom", $data_array["nom"], PDO::PARAM_STR);
        $request->execute();
        $resultat=$request->fetchAll(PDO::FETCH_OBJ);
        exit(json_encode($resultat));
       }

?>