<?php
require_once("init_data.php");

function id_user($pdo, $data) {
    $login = $data["login"];
    $password = $data["password"];
    $request = $pdo->prepare("SELECT ID_USER FROM USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
    $request->bindParam(':login', $login, PDO::PARAM_STR);
    $request->bindParam(':password', $password, PDO::PARAM_STR);
    $request->execute();
    $id = $request->fetchColumn();
    return $id;
}

switch ($_SERVER["REQUEST_METHOD"]) {
    // donne l'historique d'un utilisateur
    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $id_user = id_user($pdo,$data_array);

        // maintenant, je récupère l'historique avec le nom du plat, ID_HISTORIQUE et QUANTITE
        $request = $pdo->prepare("SELECT h.ID_HISTORIQUE, h.QUANTITE, h.DATE, p.NOM_PLAT
        FROM HISTORIQUE h
        JOIN PLATS p ON h.ID_PLAT = p.ID_PLAT
        WHERE h.ID_USER = :id_user");
        $request->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $request->execute();  
        $resultat = $request->fetchAll(PDO::FETCH_OBJ);      
        exit(json_encode($resultat));
}
?>