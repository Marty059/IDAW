
<header>
    <h1 class="titre_site">Manger Mieux</h1>
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
            $currentClass = ($pageId === $currentPageId) ? 'current' : '';
            //$currentClass = (trim($pageId) === trim($currentPageId)) ? 'current' : '';
            //echo "<div class=\"onglet\">"."<a" . $currentClass . ' href="index.php?page=' . $pageId . '">' . $pageParameters . '</a></div>';
            //echo '<div class="onglet"><a href="index.php?page='.$pageId.'.php">'. $pageParameters[0].'</a></div>';
            echo '<div class="onglet ' . $currentClass . '"><a href="index.php?page=' . $pageId . '">' . $pageParameters[0] . '</a></div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</nav>';
        echo '</header>';     


    }
?>