<?php
    session_start(); 
    // Vérifie si l'utilisateur est connecté
    if(isset($_GET['disconnect'])) {
        session_unset();
        session_destroy();
        unset($_GET['disconnect']);
        header("Location: login.php");
        exit();
    }

    if (!isset($_SESSION['login'])) {
        // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
        header("Location: login.php");
        exit();
    }

    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }

    require_once("template_header.php");
    require_once("template_menu.php");
    renderMenuToHTML($currentPageId);

?>

<section class="corps">
    <?php
        $pageToInclude = "frontend/" . $currentPageId . '.php';
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>    
</section>

<div id="deconnection">
		<a class="logout-link" href="index.php?disconnect">Logout</a>
</div>
