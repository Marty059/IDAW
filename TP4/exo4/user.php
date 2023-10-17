<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
</head>
<body>

<?php
require_once('config.php');
require_once('requete.php');
require_once('print-user.php');
?>


    <?php if(!isset($_POST['action']) || $_POST['action']=='Ajouter' || $_POST['action']=='Supprimer'|| $_POST['action']=='Update' ) {
        echo '<h2>Ajouter un utilisateur</h2>
    <form action="user.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" name="action" value="Ajouter">
    </form>';
    }
    ?>
        <?php
        if(isset($_POST['action']) && $_POST['action'] == 'Modifier') {
            $id=$_POST['id'];
            foreach ($result as $user) {
                if($user->id==$id){
                    $name=$user->name;
                    $email=$user->email;
                }
            }
        echo"<h2>Modifier l'utilisateur</h2>";
         echo'<form action="user.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" value="'.$name.'"name="nom" required>
    
            <label for="email">Email :</label>
            <input type="email" id="email" value="'.$email.'"name="email" required>

            <input type="hidden" name="id" value="'. $id.'">


    
            <input type="submit" name="action" value="Update">
        </form>';
    }
   ?> 

</body>
</html>

<?php
