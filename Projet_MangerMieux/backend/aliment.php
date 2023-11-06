<?php
require_once("init_pdo.php"); 
require_once("init_data.php")

function get_last_id_food($pdo){
    $request = $pdo->prepare("SELECT MAX(ID_ALIMENT) FROM ALIMENTS");
    $request->execute();
    $resultat= $request->fetchColumn();
    if(!isset($resultat)){
        $id = 0;
    }
    else{ $id = $resultat;}
    return $id;
};
function get_last_id_type($pdo){
    $request = $pdo->prepare("SELECT MAX(ID_TYPE) FROM `type_aliment`");
    $request->execute();
    $resultat= $request->fetchColumn();
    if(!isset($resultat)){
        $id = 0;
    }
    else{ $id = $resultat;}
    return $id;
};
function aliment_existe($data,$pdo){
    $nom_aliment = $data["product"]["generic_name"];
    $request = $pdo->prepare("SELECT COUNT(ID_ALIMENT)
    FROM ALIMENTS
    WHERE NOM_ALIMENT :aliment");
    $request->bindParam(":aliment",$nom_aliment, PDO::PARAM_STR);
    $request->execute();
    $resultat = $request->fetch(PDO::FETCH_OBJ);
    echo json_encode($resultat);
}
function ajouter_nutriments($data,$pdo){
    //ajoute les nutriments du dernier aliments
    $id_aliment= get_last_id_food($pdo);
    $request = $pdo->prepare("SELECT * FROM Nutriments");
    $request->execute();
    $resultats=$request->fetchall(PDO::FETCH_OBJ);
    foreach($resultats as $nutriment){
        $nutrimentName = $nutriment->NOM_NUTRIMENT;
        if(isset($data["product"]["nutriments"][$nutrimentName])&&($data["product"]["nutriments"][$nutrimentName]!=0)){
            //recupère l'id du nutriment
            $request = $pdo->prepare("SELECT ID_NUTRIMENT
            FROM NUTRIMENTS
            WHERE NOM_NUTRIMENT = :nutriment");
            $request->bindParam(":nutriment",$nutrimentName, PDO::PARAM_STR);
            $request->execute();
            $id_nutriment = $request->fetch(PDO::FETCH_OBJ); 
            $id_nutriment = $id_nutriment->ID_NUTRIMENT;
            $val_nutri = $data["product"]["nutriments"][$nutrimentName];
            $request = $pdo->prepare("INSERT INTO COMPOSITION_ALIMENT (ID_ALIMENT, ID_NUTRIMENT, QUANTITE_POUR_100G)
            VALUES (:idAliment, :idNutriment, :valeurNutritionnelle);");
            $request->bindParam(":idAliment",$id_aliment, PDO::PARAM_STR);
            $request->bindParam(":idNutriment",$id_nutriment, PDO::PARAM_STR);
            $request->bindParam(":valeurNutritionnelle",$val_nutri, PDO::PARAM_STR);
            $request->execute();
        }
   }
}
function ajouter_aliment($data,$pdo){
    $kcal=$data["product"]["nutriments"]["energy-kcal"];
    $id_aliment = get_last_id_food($pdo);
    $id_aliment=$id_aliment+1;
    $id_type = get_last_id_type($pdo);
    $nomAliment = $data["product"]["generic_name"];
    $request = $pdo->prepare("INSERT INTO ALIMENTS (ID_ALIMENT,ID_TYPE,NOM_ALIMENT,Kcal) VALUES (:idAlim,:idType,:nomAliment,:kcal)");
    $request->bindParam(':idAlim', $id_aliment, PDO::PARAM_INT);
    $request->bindParam(':idType', $id_type, PDO::PARAM_INT);
    $request->bindParam(':nomAliment', $nomAliment, PDO::PARAM_STR);
    $request->bindParam(':kcal', $kcal, PDO::PARAM_STR);
    $request->execute(); 
}
function ajouter_type($data,$pdo){ 
    //vérifie si le type existe et s'il existe pas créer un nouveau type 
    $type=$data["product"]["food_groups"];
    $type = substr($type,3);//nom du type
    $id_type= get_last_id_type($pdo);
    $id_type=$id_type+1;
    $request = $pdo->prepare("SELECT * FROM TYPE_ALIMENT WHERE NOM_TYPE = :type;");
    $request->bindParam(":type", $type, PDO::PARAM_STR);
    $request->execute();
    $resultat=$request->fetchall(PDO::FETCH_OBJ);
    if(count($resultat) ==0){
        $request = $pdo->prepare("INSERT INTO TYPE_ALIMENT (ID_TYPE,NOM_TYPE) VALUES (:idType,:type);");
        $request->bindParam(":type", $type, PDO::PARAM_STR);
        $request->bindParam(":idType", $id_type, PDO::PARAM_STR);
        $request->execute();
    }
    //renvoie l'id du type 
    return $id_type;
    
}
function supprimer_aliment($id,$pdo){
    $request= $pdo->prepare("DELETE FROM ALIMENTS WHERE ID_ALIMENT = :idAlim");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();

}
function supprimer_nutriment_de($id,$pdo){
    $request=$pdo->prepare("DELETE FROM COMPOSITION_ALIMENT WHERE ID_ALIMENT = :idAlim ");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();
}
switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':   
        $request = $pdo->prepare("SELECT * FROM ALIMENTS");
        $request->execute();
        $resultat=$request->fetchall(PDO::FETCH_OBJ);
        exit(json_encode($resultat));

    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $url = "https://world.openfoodfacts.org/api/v2/product/".$data_array["code"].".json";
        $response = file_get_contents($url);
        $data=json_decode($response,true);
        //aliment_existe($data,$pdo);
        ajouter_aliment($data,$pdo);  
        ajouter_nutriments($data,$pdo);
    
    case 'DELETE':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $id_aliment = $data_array["id"];
        supprimer_nutriment_de($id_aliment,$pdo);
        supprimer_aliment($id_aliment,$pdo);
    }
?>
