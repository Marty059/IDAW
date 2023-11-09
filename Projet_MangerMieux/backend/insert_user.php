<?php
require_once("init_data.php");
function get_last_id_users($pdo){
    $request = $pdo->prepare("SELECT MAX(ID_USER) FROM USERS");
    $request->execute();
    $resultat= $request->fetchColumn();
    if(!isset($resultat)){
        $id = 0;
    }
    else{ $id = $resultat;}
    return $id;
}
//renvoie true s'il y a pas de doublon, false sinon 
function not_doublon($pdo,$data){
    $login = $data["login"];
    $password = $data["password"];    
    $request = $pdo->prepare("SELECT COUNT(*) as count FROM USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
    $request->bindParam(':login', $login, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    $resultat= $request->fetchColumn();
    if($resultat!=0){
        return false;
    }
    else{
        return true;
    }
}
switch ($_SERVER["REQUEST_METHOD"]) {
    //ajoute un nouvel utilisateur
    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $count=0;
        foreach($data_array as $data ){
            if(isset($data)){
                $count=$count+1;
            }
        }
        if($count==9){
            $id_user= get_last_id_users($pdo)+1;
            $id_pratique = $data_array["pratique"];
            $nom=$data_array["nom"];
            $prenom=$data_array["prenom"];
            $genre = $data_array["genre"];
            $taille = $data_array["taille"];
            $poids = $data_array["poids"];
            $age = $data_array["age"];
            $login = $data_array["login"];
            $password = $data_array["password"];
            if(not_doublon($pdo,$data_array)){
                $request=$pdo->prepare("INSERT INTO USERS (ID_USER, ID_PRATIQUE,NOM,PRENOM,GENRE,TAILLE,POIDS,AGE,LOGIN,MOT_DE_PASSE)
                VALUES (:id_user, :id_pratique,:nom,:prenom,:genre,:taille,:poids,:age,:login,:password);");
                $request->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $request->bindParam(':id_pratique', $id_pratique, PDO::PARAM_INT);
                $request->bindParam(':nom', $nom, PDO::PARAM_STR);
                $request->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $request->bindParam(':genre', $genre, PDO::PARAM_STR);
                $request->bindParam(':taille', $taille, PDO::PARAM_INT);
                $request->bindParam(':poids', $poids, PDO::PARAM_INT);
                $request->bindParam(':age', $age, PDO::PARAM_INT);
                $request->bindParam(':login', $login, PDO::PARAM_STR);
                $request->bindParam(':password', $password, PDO::PARAM_STR);
                $request->execute();
                echo "votre compte a bien été créé";
                exit(json_encode(array()));
            }
            else{
                echo "existe deja";
                exit(json_encode(array()));
            }
        }
        else{
            echo "veuillez remplir tout les champs";
            exit(http_response_code(201));
        }

}?>