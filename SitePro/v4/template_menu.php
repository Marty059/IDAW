<?php
    function renderMenuToHTML($currentPageId, $currentLanguage) {

        //définit current page 
        // un tableau qui definit la structure du site
            $mymenu = array(
                'fr' => array(
                    'accueil' => 'Accueil',
                    'cv' => 'Cv' ,
                    'hobbies' => 'Mes Hobbies',
                    'contact' => 'Contact'
                ),
        
                'en' => array(
                    'accueil' => 'Home',
                    'cv' => 'Resume',
                    'hobbies' => 'My Hobbies',
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
        echo '</div>';
        echo '</nav>';
        echo '</header>';

    }
?>

    