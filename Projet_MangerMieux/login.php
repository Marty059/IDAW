<?php
    require_once("template_header.php");
?>

<body class="body_inscription">
    <header>
        <h1 class="titre_site_inscription">Manger Mieux</h1>
    </header>
    <form id="loginForm">
        <label class="l_inscription" for="login">Login :</label>
        <input type="text" name="login" id="login" required>

        <br>

        <label class="l_inscription" for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <br>

        <input class="submit_inscription" type="submit" value="Se Connecter">
    </form>

    <div id="message"></div>

<?php
        $pageToInclude = "frontend/from_session.php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>

    <a href="inscription.php"><button>Inscription</button></a>