<?php 
require_once('init_pdo.php');
switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':   
        $data_array = json_decode(file_get_contents('php://input'), true);
        $request = $pdo->prepare("SELECT
        a.NOM_ALIMENT AS Aliment,
        n.NOM_NUTRIMENT AS Nutriment,
        ca.QUANTITE_POUR_100G AS Quantite_Pour_100g
    FROM
        aliments a
    JOIN
        composition_aliment ca ON a.ID_ALIMENT = ca.ID_ALIMENT
    JOIN
        nutriments n ON ca.ID_NUTRIMENT = n.ID_NUTRIMENT
    WHERE
        a.NOM_ALIMENT = :nom;");

        $request->bindParam(":nom", $data_array["nom"], PDO::PARAM_STR);
        $request->execute();
        $resultat=$request->fetchAll(PDO::FETCH_OBJ);
        exit(json_encode($resultat));
       }

?>