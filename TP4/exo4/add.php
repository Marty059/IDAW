<?php
$pdo = NULL;
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


        /*header("Location: user.php");
        exit();*/
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }

    $pdo=null;
}