<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui definit la structure du site
        $mymenu = array(
            // idPage titre
            'acceuil' => array( 'Accueil' ),
            'aliments' => array( 'Aliments' ),
            'historique' => array('Mon historique'),
            'compte' => array('Mon compte'),
            'credits' => array('A propos')
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