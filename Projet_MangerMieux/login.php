<?php
        $pageToInclude = "frontend/from_session.php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>