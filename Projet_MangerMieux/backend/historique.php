<?php
require_once("init_data.php");
function id_user($pdo,$data){
    $login = $data["login"];
    $password = $data["password"];
    $request=$pdo->prepare("select ID_USER from USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
    $request->bindParam(':login', $login, PDO::PARAM_INT);
    $request->bindParam(':password', $password, PDO::PARAM_INT);
    $request->execute();
    $id=$request->fetchColumn();
    return $id;
}
switch($_SERVER["REQUEST_METHOD"]){
    //donne l'historique d'un utilisateur
    case 'GET':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $login = $data_array["login"];
        $password = $data_array["password"];

        // il faut récupérer l'id de l'utilisateur
        $request = $pdo->prepare("SELECT ID_USER FROM USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
        $request->bindParam(':login', $login, PDO::PARAM_STR);
        $request->bindParam(':password', $password, PDO::PARAM_STR);
        $request->execute();
        $id_user = $request->fetchColumn();

        // maintenant, je récupère l'historique avec le nom du plat
        $request = $pdo->prepare("SELECT h.*, p.NOM_PLAT
            FROM HISTORIQUE h
            JOIN PLATS p ON h.ID_PLAT = p.ID_PLAT
            WHERE h.ID_USER = :id_user");
        $request->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $request->execute();  
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);      
        exit(json_encode($resultat));
    //ajoute un aliment dans l'historique 
    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $id_user = id_user($pdo,$data_array);
        $id_plat = $data_array["id_plat"];
        $date = date('Y-m-d ');;
        if ($data_array !== null && isset($data_array["id_plat"])){
            $request = $pdo->prepare("INSERT INTO HISTORIQUE (ID_USER,ID_PLAT,DATE) VALUES (:idUser,:idPlat,:date)");
            $request->bindParam(':idUser', $id_user, PDO::PARAM_INT);
            $request->bindParam(':idPlat', $id_plat, PDO::PARAM_INT);
            $request->bindParam(':date', $date, PDO::PARAM_STR);
            $request->execute();
            exit();
        }
        else{
            echo "le plat n'existe pas";
            exit();
        }
    case 'DELETE':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $id_plat = $data_array["id_plat"];
        //récupère id user
        $id_user = id_user($pdo,$data_array);
        $request = $pdo->prepare("DELETE FROM HISTORIQUE WHERE id_user = :id_user AND id_plat = :id_plat;");
        $request->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $request->bindParam(':id_plat', $id_plat, PDO::PARAM_INT);
        $request->execute();
    }

        

    

?>