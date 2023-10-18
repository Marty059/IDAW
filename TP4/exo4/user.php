<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .action-buttons {
        display: flex;
        justify-content: space-between;
        }

        .btn-edit, .btn-delete {
            padding: 8px 12px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: #fff;
        }

        .btn-edit {
            background-color: #4CAF50;
        }

        .btn-delete {
            background-color: #f44336;
        }
    </style>
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
