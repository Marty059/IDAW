<?php
require_once("init_pdo.php");
require_once("function.php");

function setHeaders() {
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}

// ==============
// Responses
// ==============

switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        $result = get_users($pdo);
        setHeaders();
        exit(json_encode($result));

    case 'POST':
        // Récupérer les données du corps de la requête
        $data = json_decode(file_get_contents("php://input"));

        // Vérifier si les données nécessaires sont présentes
        if (isset($data->name) && isset($data->email)) {
            $user_id = create_user($pdo, $data->name, $data->email);
            setHeaders();

            // Retourner le statut Created (201) et l'ID de l'utilisateur créé
            http_response_code(201);
            exit(json_encode(['user_id' => $user_id]));
        } else {
            // Retourner un statut BadRequest (400) si les données sont incomplètes
            http_response_code(400);
            exit(json_encode(['error' => 'Bad Request']));
        }
    
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        // Utiliser $data->user_id pour obtenir l'ID de l'utilisateur à mettre à jour
        if (isset($data->user_id) && isset($data->name) && isset($data->email)) {
            $user_id = $data->user_id;
            update_user($pdo, $user_id, $data->name, $data->email);
            setHeaders();
            http_response_code(200);
            exit(json_encode(['message' => 'User updated successfully']));
        } else {
            setHeaders();
            http_response_code(400);
            exit(json_encode(['error' => 'Bad Request']));
        }

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        // Utiliser $data->user_id pour obtenir l'ID de l'utilisateur à mettre à jour
        if (isset($data->user_id)) {
            $user_id = $data->user_id;
            delete_user($pdo, $user_id);
            setHeaders();
            http_response_code(200);
            exit(json_encode(['message' => 'User deleted successfully']));
        } else {
            setHeaders();
            http_response_code(400);
            exit(json_encode(['error' => 'Bad Request']));
        }
   
}