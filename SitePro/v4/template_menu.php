<?php
    function renderMenuToHTML($currentPageId, $currentLanguage) {

        //définit current page 
        // un tableau qui definit la structure du site
            $mymenu = array(
                'fr' => array(
                    'accueil' => 'Accueil',
                    'cv' => 'Cv' ,
                    'hobbies' => 'Mes Hobbies',
                    'projets' => 'Mes Projets',
                    'contact' => 'Contact'
                ),
        
                'en' => array(
                    'accueil' => 'Home',
                    'cv' => 'Resume',
                    'hobbies' => 'My Hobbies',
                    'projets' => 'Mes Projects',
                    'contact' => 'Contact me'
                )
            );
        
        echo '<nav class="menu">';
        echo '<div>';
        echo '<div class="menu_principal">';
        foreach($mymenu[$currentLanguage] as $pageId => $pageParameters) {
            //echo "<div class=\"onglet\"><a href=\"index.php?page={$pageId}\">{$pageParameters[0]}</a></div>";
            $currentClass = ($pageId === $currentPageId) ? ' id="currentPage"' : '';
            $langParam = '&lang=' . $currentLanguage; // Ajout du paramètre de langue
            echo "<div class=\"onglet\">"."<a" . $currentClass . ' href="index.php?page=' . $pageId . $langParam . '">' . $pageParameters . '</a></div>';
        }
        echo '</div>';

        // Menu déroulant pour changer de langue
        echo '<form class="lang-form" action="index.php" method="get" id="lang-form">';
        echo '<input type="hidden" name="page" value="' . $currentPageId . '">';
        echo '<select class="langSelect" name="lang" id="langSelect" onchange="document.getElementById(\'lang-form\').submit();">';
        echo '<option value="fr"' . ($currentLanguage === 'fr' ? ' selected' : '') . '>Français</option>';
        echo '<option value="en"' . ($currentLanguage === 'en' ? ' selected' : '') . '>English</option>';
        echo '</select>';
        echo '</form>';

        echo '</div>';
        echo '</nav>';
        echo '</header>';


    }
?>