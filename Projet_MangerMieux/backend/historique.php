<?php
require_once("init_data.php");
function id_user($pdo,$data){
    $login = $data["login"];
    $password = $data["password"];
    $request=$pdo->prepare("select ID_USER from USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
    $request->bindParam(':login', $login, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    $id=$request->fetchColumn();
    return $id;
}
function get_last_id_histo($pdo){
    $request = $pdo->prepare("SELECT MAX(ID_HISTORIQUE) FROM historique");
    $request->execute();
    $resultat= $request->fetchColumn();
    if(!isset($resultat)){
        $id = 0;
    }
    else{ $id = $resultat;}
    return $id;
}
switch($_SERVER["REQUEST_METHOD"]){
    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $id_user = id_user($pdo,$data_array);
        $id_plat = $data_array["id_plat"];
        $id_historique = get_last_id_histo($pdo)+1;
        $date = date('Y-m-d H:i:s');
        $quantite = $data_array["quantite"];
        if ($data_array !== null && isset($data_array["id_plat"])){
            $request = $pdo->prepare("INSERT INTO HISTORIQUE (ID_HISTORIQUE,ID_USER,ID_PLAT,DATE,Quantite) VALUES (:id_histo,:idUser,:idPlat,:date,:quantite)");
            $request->bindParam(':idUser', $id_user, PDO::PARAM_INT);
            $request->bindParam(':idPlat', $id_plat, PDO::PARAM_INT);
            $request->bindParam(':date', $date, PDO::PARAM_STR);
            $request->bindParam(':quantite', $quantite, PDO::PARAM_INT);
            $request->bindParam(':id_histo', $id_historique, PDO::PARAM_INT);
            $request->execute();
            exit();
        }
        else{
            echo "le plat n'existe pas";
            exit();
        }
    case 'DELETE':
        $data_array = json_decode(file_get_contents('php://input'), true);


        $id_historique = $data_array["id_historique"];
        //récupère id user
        $request = $pdo->prepare("DELETE FROM HISTORIQUE WHERE id_historique = :id_historique;");
        $request->bindParam(':id_historique', $id_historique, PDO::PARAM_INT);
        $request->execute();
    }

        

    

?>