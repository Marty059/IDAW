<?php
require_once("init_data.php");

switch($_SERVER["REQUEST_METHOD"]){
    // donne l'historique d'un utilisateur
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
}
?>
