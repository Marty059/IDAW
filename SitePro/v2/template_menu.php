<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui definit la structure du site
        $mymenu = array(
            // idPage titre
            'index' => array( 'Accueil' ),
            'cv' => array( 'Cv' ),
            'hobbies' => array('Mes Hobbies')
        );
        echo '<nav class="menu">';
        echo '<div>';
        echo '<div class="menu_principal">';
        foreach($mymenu as $pageId => $pageParameters) {
            echo '<div class="onglet"><a href="'.$pageId.'.php">'. $pageParameters[0].'</a></div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</nav>';
        echo '</header>';

    }
?>