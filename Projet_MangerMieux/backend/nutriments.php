<?php 
require_once('init_data.php');
function nom_nutriment($pdo,$id){

}

switch($_SERVER["REQUEST_METHOD"]){
    //donne nutriments d'un plat donné
    case 'GET': 
        //récupère les nutriments  
        $data_array = json_decode(file_get_contents('php://input'), true);
        $request = $pdo->prepare("SELECT * FROM composition_aliment WHERE ID_ALIMENT = :id ");
        $request->bindParam(":id", $data_array["id"], PDO::PARAM_STR);
        $request->execute();
        $resultat=$request->fetchAll(PDO::FETCH_OBJ);
        $val = array_column($resultat, 'QUANTITE_POUR_100G');
        $count =0;
        $data = array();
        foreach($resultat as $nutriment){
            $id_nutri = $nutriment->ID_NUTRIMENT;
            $request = $pdo->prepare("SELECT NOM_NUTRIMENT FROM NUTRIMENTS WHERE ID_NUTRIMENT = :id ");
            $request->bindParam(":id",$id_nutri, PDO::PARAM_INT);
            $request->execute();
            $nom_nutri = $request->fetchColumn();
            $element = array(
                "NOM_NUTRIMENT" => $nom_nutri,
                "QUANTITE_POUR_100G" => $val[$count]
            );    
            $data[]=$element; 
            $count=$count+1;
        }
        
        //récupère le nom du nutriment en fonction de l'id 
      
        exit(json_encode($data));
       }

?>