<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de Connexion</title>
</head>
<body>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION["login"]= $_POST["login"];
    $_SESSION["password"]=$_POST["password"];
    header('Location: test_session.php');
    exit();
    
}?>
<form method="post" action="">
    <label for="login">Login :</label>
    <input type="text" name="login" id="login" required>

    <br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>

    <br>

    <input type="submit" value="Se Connecter">
</form>

</body>
</html>
