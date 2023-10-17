<?php
$pdo = NULL;
if(isset($_POST['action'])){
    switch ($_POST['action']) {
        case 'Ajouter':
            if(isset($_POST['nom']) && isset($_POST['email'])) {
                try {
                    $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Récupérer les données du formulaire
                    $nom = $_POST['nom'];
                    $email = $_POST['email'];

                    // Préparer et exécuter la requête SQL
                    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
                    $stmt->bindParam(':name', $nom);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    echo "Utilisateur ajouté avec succès.";
                }
                catch (PDOException $erreur) {
                    echo 'Erreur : '.$erreur->getMessage();
                }

                $pdo=null;
            }
        break;
        
        case'Update':
            try {
                $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupérer les données du formulaire
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $id = $_POST['id'];

                // Préparer et exécuter la requête SQL
                $stmt = $pdo->prepare("UPDATE `users` SET `name` = :name, `email` = :email WHERE `users`.`id` = :id");
                $stmt->bindParam(':name', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                echo "Utilisateur modifié avec succès.";
            }
            catch (PDOException $erreur) {
                echo 'Erreur : '.$erreur->getMessage();
            }

            $pdo=null;
        break;
        
        case'Supprimer':
            try {
                $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupérer les données du formulaire
                $id = $_POST['id'];

                // Préparer et exécuter la requête SQL
                $stmt = $pdo->prepare("DELETE FROM `users` WHERE `users`.`id` = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                echo "Utilisateur supprimé avec succès.";
            }
            catch (PDOException $erreur) {
                echo 'Erreur : '.$erreur->getMessage();
            }

            $pdo=null;
        break;
    }

    
}