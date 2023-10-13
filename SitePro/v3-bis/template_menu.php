<?php
    function renderMenuToHTML($currentPageId) {

        //définit current page 
        // un tableau qui definit la structure du site
        $mymenu = array(
            // idPage titre
            'accueil' => array( 'Accueil' ),
            'cv' => array( 'Cv' ),
            'hobbies' => array('Mes Hobbies')
        );
        echo '<nav class="menu">';
        echo '<div>';
        echo '<div class="menu_principal">';
        foreach($mymenu as $pageId => $pageParameters) {
            echo "<div class=\"onglet\"><a href=\"index.php?page={$pageId}\">{$pageParameters[0]}</a></div>";
        }
        echo '</div>';
        echo '</div>';
        echo '</nav>';
        echo '</header>';

    }
?>