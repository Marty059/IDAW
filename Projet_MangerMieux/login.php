<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de Connexion</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclure jQuery -->
</head>
<body>
    <form id="loginForm">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required>

        <br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <br>

        <input type="submit" value="Se Connecter">
    </form>

    <div id="message"></div>

<?php
        $pageToInclude = "frontend/from_session.php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>