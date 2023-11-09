<?php
    require_once("template_header.php");
    $pageToInclude = "frontend/inscription.php";
    if(is_readable($pageToInclude))
        require_once($pageToInclude);
    else
        require_once("error.php");
?>
