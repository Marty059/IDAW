<?php
require_once("init_pdo.php"); 

function ajouter_nutriments($data){
    //récupère les nutriments
    $request = $pdo->prepare("SELECT * FROM Nutriments");
    $request->execute();
    $resultats=$request->fetchall(PDO::FETCH_OBJ);
    $nutriments =json_decode($resultats, true);
    foreach($nutriments as $nurtiment){
        if(isset($data["product"]["nutriments"][$nurtiment])){
            $request = $pdo->prepare("SELECT * FROM Nutriments");
        }
    }
}
function ajouter_type($data,$pdo){ 
    $type=$data["product"]["food_groups"];
    $type = substr($type,3);
    echo $type;
    $request = $pdo->prepare("SELECT * FROM TYPE_ALIMENT WHERE NOM_TYPE = :type;");
    $request->bindParam(":type", $type, PDO::PARAM_STR);
    $request->execute();
    $resultat=$request->fetchall(PDO::FETCH_OBJ);
    echo (count($resultat));
    if(count($resultat) ==0){
        $request = $pdo->prepare("INSERT INTO TYPE_ALIMENT (NOM_TYPE) VALUES (:type);");
        $request->bindParam(":type", $type, PDO::PARAM_STR);
        $request->execute();
        return('j ai ajouter ');
    }  
    
    
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
        //$reponse = ajouter_type($data,$pdo);
        $reponse = $data["product"]["food_groups"];
        echo (ajouter_type($data,$pdo));
        $reponse = substr($reponse,3);
        exit(json_encode($reponse));
        
        }
?>
