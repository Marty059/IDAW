<?php
require_once("init_data.php");

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        $data_array = json_decode(file_get_contents('php://input'), true);
        $login = $data_array["login"];
        $password = $data_array["password"];
        
        $request = $pdo->prepare("SELECT COUNT(*) as count FROM USERS WHERE LOGIN = :login AND MOT_DE_PASSE = :password");
        $request->bindParam(':login', $login, PDO::PARAM_STR);
        $request->bindParam(':password', $password, PDO::PARAM_STR);
        $request->execute();
        $resultat = $request->fetch(PDO::FETCH_OBJ);
        if (isset($resultat)) {
            
            session_start();
            $_SESSION['password']=$password;
            $_SESSION['login']=$login;
            exit(json_encode(array()));
        } else {
            exit(http_response_code(204));
        }
}?>