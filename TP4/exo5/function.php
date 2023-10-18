<?php
function get_users($db){
    $request = $db->prepare("select * from users");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function create_user($db, $name, $email) {
    $request = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $request->bindParam(':name', $name);
    $request->bindParam(':email', $email);
    $request->execute();

    // Récupérer l'ID généré automatiquement
    $user_id = $db->lastInsertId();

    return $user_id;
}

function update_user($db, $user_id, $name, $email) {
    $request = $db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :user_id");
    $request->bindParam(':user_id', $user_id);
    $request->bindParam(':name', $name);
    $request->bindParam(':email', $email);
    $request->execute();
}

function delete_user($db, $user_id) {
    $request = $db->prepare("DELETE FROM users WHERE id = :user_id");
    $request->bindParam(':user_id', $user_id);
    $request->execute();
}