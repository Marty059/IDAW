<?php 

require_once("init_data.php");

function is_in($pdo,$param,$table,$value){
    $request=$pdo->prepare("SELECT COUNT(*) FROM $table WHERE $param = :value;");
    $request->bindParam(':value', $value, PDO::PARAM_STR);
    $request->execute();
    $resultat= $request->fetchColumn();
    return($resultat);
}
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
function get_last_id_plat($pdo){
    $request = $pdo->prepare("SELECT MAX(ID_PLAT) FROM PLATS");
    $request->execute();
    $resultat= $request->fetchColumn();
    if(!isset($resultat)){
        $id = 0;
    }
    else{ $id = $resultat;}
    return $id;
}
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
function aliment_existe($code,$pdo){
    $request = $pdo->prepare("SELECT COUNT(ID_ALIMENT) AS count
    FROM ALIMENTS
    WHERE CODE  = :code");
    $request->bindParam(":code", $code, PDO::PARAM_STR);
    $request->execute();
    $resultat = $request->fetch(PDO::FETCH_ASSOC);
    $count = $resultat['count']; 
    return $count;

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
function ajouter_type($data,$pdo){ 
    //vérifie si le type existe et s'il existe pas créer un nouveau type 
    $type=$data["product"]["food_groups"];
    $type = substr($type,3);//nom du type
    $request = $pdo->prepare("SELECT * FROM TYPE_ALIMENT WHERE NOM_TYPE = :type;");
    $request->bindParam(":type", $type, PDO::PARAM_STR);
    $request->execute();
    $resultat=$request->fetchall(PDO::FETCH_OBJ);
    //si le type existe pas
    if(count($resultat) ==0){
        //lui créer un id
        $id_type= get_last_id_type($pdo);
        $id_type=$id_type+1;
        $request = $pdo->prepare("INSERT INTO TYPE_ALIMENT (ID_TYPE,NOM_TYPE) VALUES (:idType,:type);");
        $request->bindParam(":type", $type, PDO::PARAM_STR);
        $request->bindParam(":idType", $id_type, PDO::PARAM_INT);
        $request->execute();
    }
    //si le type existe
    else{
        $request = $pdo->prepare("SELECT ID_TYPE as id FROM TYPE_ALIMENT WHERE NOM_TYPE = :type;");
        $request->bindParam(":type", $type, PDO::PARAM_INT);
        $request->execute();
        $id_type=$request->fetchColumn();

    }
    //renvoie l'id du type 
    return $id_type;
    
}
function ajouter_aliment($code,$data,$pdo){
    $pourcentage=100;
    $kcal=$data["product"]["nutriments"]["energy-kcal"];
    $id_aliment = get_last_id_food($pdo);
    $id_plat = get_last_id_plat($pdo);
    $id_plat = $id_plat+1;
    $id_aliment=$id_aliment+1;
    $id_type = ajouter_type($data,$pdo);
    $nomAliment = $data["product"]["product_name"];
    $request = $pdo->prepare("INSERT INTO ALIMENTS (ID_ALIMENT,ID_TYPE,NOM_ALIMENT,Kcal,CODE) VALUES (:idAlim,:idType,:nomAliment,:kcal,:code)");
    $request->bindParam(':idAlim', $id_aliment, PDO::PARAM_INT);
    $request->bindParam(':idType', $id_type, PDO::PARAM_INT);
    $request->bindParam(':nomAliment', $nomAliment, PDO::PARAM_STR);
    $request->bindParam(':kcal', $kcal, PDO::PARAM_INT);
    $request->bindParam(':code',$code , PDO::PARAM_INT);
    $request->execute();
    //comme un aliment est un plat on ajoute l'aliment dans la table plat
    echo  $nomAliment;
    $request = $pdo->prepare("INSERT INTO PLATS (ID_PLAT,NOM_PLAT) VALUES (:idPlat,:nomAliment)");
    $request->bindParam(':idPlat', $id_plat, PDO::PARAM_INT);
    $request->bindParam(':nomAliment', $nomAliment,PDO::PARAM_STR);
    $request->execute();
    //ajoute la composition du plat
    $request = $pdo->prepare("INSERT INTO composition_plat (ID_PLAT,ID_ALIMENT,POURCENTAGE) VALUES (:idPlat,:idAlim,:pourcentage)");
    $request->bindParam(':idPlat', $id_plat, PDO::PARAM_INT);
    $request->bindParam(':idAlim', $id_aliment, PDO::PARAM_INT);
    $request->bindParam(':pourcentage', $pourcentage, PDO::PARAM_STR);
    $request->execute();
}
function supprimer_aliment($id,$pdo){
    $request= $pdo->prepare("DELETE FROM composition_aliment WHERE ID_ALIMENT = :idAlim");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();
    $request= $pdo->prepare("DELETE FROM composition_plat WHERE ID_ALIMENT = :idAlim");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();
    $request= $pdo->prepare("DELETE FROM ALIMENTS WHERE ID_ALIMENT = :idAlim");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();
    $request= $pdo->prepare("DELETE FROM PLATS WHERE ID_PLAT = :idAlim");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();

}
function supprimer_nutriment_de($id,$pdo){
    $request=$pdo->prepare("DELETE FROM COMPOSITION_ALIMENT WHERE ID_ALIMENT = :idAlim ");
    $request->bindParam(':idAlim', $id, PDO::PARAM_INT);
    $request->execute();
}
$current_url = $_SERVER['REQUEST_URI'];
switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':
        $url_parts = parse_url($current_url);
        $segments = explode('/', $url_parts['path']);
        $id = end($segments);
        $table = "aliments";
        $param = 'ID_ALIMENT';
        
        if(is_in($pdo,$param,$table,$id)!=0){
            $request = $pdo->prepare("SELECT * FROM ALIMENTS WHERE ID_ALIMENT = :id");
            $request->bindParam(':id', $id, PDO::PARAM_STR);
            $request->execute();
            $resultat=$request->fetch(PDO::FETCH_OBJ);
            exit(json_encode($resultat));}
        else{exit(http_response_code(204));}

    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $code = $data_array["code"];
        if ($data_array !== null && isset($data_array["code"])) {
            $url = "https://world.openfoodfacts.org/api/v2/product/".$data_array["code"].".json";
            $response = file_get_contents($url);
            $data=json_decode($response,true);
            $count = aliment_existe($code,$pdo);
            //s'il l'aliment existe pas
            if($count==0){
                ajouter_aliment($code,$data,$pdo);
                ajouter_nutriments($data,$pdo);
                exit();
            }
            else {
                echo "l'aliment existe déjà";
                exit();
            }
        }
        exit();
    
    case 'DELETE':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $id_aliment = $data_array["id"];
        $table ="ALIMENTS";
        $param="ID_ALIMENT";
        if(is_in($pdo,$param,$table,$id_aliment)!=0){
            supprimer_nutriment_de($id_aliment,$pdo);
            supprimer_aliment($id_aliment,$pdo);
            exit();
        }
        else{exit(http_response_code(204));}
    }
?>
