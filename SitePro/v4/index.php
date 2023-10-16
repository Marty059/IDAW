<?php
    $currentPageId = 'accueil';
    $currentLanguage = 'fr';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    if(isset($_GET['lang'])) {
        $currentLanguage = $_GET['lang'];
    }
    
    require_once("template_header.php");
    require_once("template_menu.php");
    renderMenuToHTML($currentPageId,$currentLanguage);
?>
<section class="corps">

<?php
    if ($currentLanguage == "en"){
        $pageToInclude = "en/" . $currentPageId . ".php";
    } else {
        $pageToInclude = "fr/" . $currentPageId . ".php";
    }
    if(is_readable($pageToInclude))
        require_once($pageToInclude);
    else
        require_once("error.php");

    ?>

</section>
