<?php
    require_once('template_header.php');

    require_once('template_menu.php');
    renderMenuToHTML('index');

   //print_r($_GET);

   // on simule une base de données
    $users = array(
    // login => password
        'riri' => 'fifi',
        'yoda' => 'maitrejedi' );
    
    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;
    
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin=$_POST['login'];
        $tryPwd=$_POST['password'];
        
        // si login existe et password correspond
        if( array_key_exists($tryLogin,$users) && $users[$tryLogin]==$tryPwd ) {
        $successfullyLogged = true;
        $login = $tryLogin;
        session_start();
        $_SESSION['login'] = $login;
        } else
            $errorText = "Erreur de login/password";
    } else
        $errorText = "Merci d'utiliser le formulaire de login";
    
    if(!$successfullyLogged) {
        echo $errorText;
    } else {
        echo "<h1>Bienvenu ".$login."</h1>";
    }
?>

<form id="login_form" action="index.php" method="POST">
    <table>
        <tr>
            <th>Login :</th>
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <th>Mot de passe :</th>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="Se connecter..." /></td>
        </tr>
    </table>
</form>

    <div class="conteneur">
        <div class="bloc-texte">
            <p>Bonjour</p>
        </div>
        <div class="bloc-image">
            <img src="../Photo identité Martin Delsart - Copie.jpg" alt="Photo d'identité">
        </div>
    </div>

    <h1>Accueil</h1>
    <p class="c1">Ce paragraphe centré</p>
    <p class="c2">Ce paragraphe sera rouge</p>
    <p class="c1 c2">Ce paragraphe sera centré et rouge</p>
</body>
</html>