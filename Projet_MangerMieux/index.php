<?php
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
