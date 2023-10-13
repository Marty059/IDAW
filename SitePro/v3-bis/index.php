<?php
    require_once("template_header.php");
    require_once("template_menu.php");

    $currentPageId = 'accueil';
    $currentLanguage = 'fr';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    if(isset($_GET['lang'])) {
        $currentLanguage = $_GET['lang'];
    }
?>


<header class="bandeau_haut">
    <h1 class="titre">Test</h1>
</header>

<?php
    
    renderMenuToHTML($currentPageId);
?>
<section class="corps">

    <?php
        $pageToInclude = $currentPageId . ".php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");

    ?>

</section>
