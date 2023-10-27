<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui definit la structure du site
        $mymenu = array(
            // idPage titre
            'accueil' => array( 'Accueil' ),
            'aliments' => array( 'Aliments' ),
            'historique' => array('Mon historique'),
            'compte' => array('Mon compte'),
            'credits' => array('A propos')
        );
        echo '<nav class="menu">';
        echo '<div>';
        echo '<div class="menu_principal">';
        foreach($mymenu as $pageId => $pageParameters) {
            //$currentClass = ($pageId === $currentPageId) ? ' id="currentPage"' : '';
            //echo "<div class=\"onglet\">"."<a" . $currentClass . ' href="index.php?page=' . $pageId . '">' . $pageParameters . '</a></div>';
            echo '<div class="onglet"><a href="index.php?page='.$pageId.'.php">'. $pageParameters[0].'</a></div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</nav>';
        echo '</header>';

    }
?>