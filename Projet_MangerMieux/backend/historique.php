<?php
require_once("init_data.php");
switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $login = $data_array["login"];
        $password = $data_array["password"];
        //il faut récupérer l'id de l'user
        $request=$pdo->prepare("select ID_USER from USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
        $request->bindParam(':login', $login, PDO::PARAM_INT);
        $request->bindParam(':password', $password, PDO::PARAM_INT);
        $request->execute();
        $id=$request->fetchColumn();
        //maintenant je récupère l'historique
        $request=$pdo->prepare("select * from HISTORIQUE WHERE ID_USER = :id");
        $request->bindParam(':id', $id, PDO::PARAM_INT);
        $request->execute();  
        $resultat=$request->fetchall(PDO::FETCH_OBJ);      
        exit(json_encode($resultat));
    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $name = $data_array["nom"];
        $user = $data_array["user"];
        $date = $data_array["date"];
        if ($data_array !== null && isset($data_array["code"])){
            $request = $pdo->prepare("INSERT INTO HISTORIQUE (ID_USER,ID_PLAT,DATE) VALUES (:idUser,:idPlat,:date)");
            $request->bindParam(':idUser', $user, PDO::PARAM_INT);
            $request->bindParam(':idPlat', $name, PDO::PARAM_INT);
            $request->bindParam(':date', $date, PDO::PARAM_STR);
            $request->execute();
        }
        else{echo "l'aliment n'existe pas";}
    
    }

?>