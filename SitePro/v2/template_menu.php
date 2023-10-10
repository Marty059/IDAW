    <nav class="menu">
        <div>
            <div class="menu_principal">
                <div class="onglet"><a href="index.php">Accueil</a></div>
                <div class="onglet"><a href="cv.php">CV</a></div>
                <div class="onglet"><a href="hobbies.php">Hobbies</a></div>
            </div>
        </div>
    </nav>
</header>

<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site
        $mymenu = array(
            // idPage titre
            'index' => array( 'Accueil' ),
            'cv' => array( 'Cv' ),
            'projets' => array('Mes Projets')
        );
        // ...
        foreach($mymenu as $pageId => $pageParameters) {
            echo "...";
        }
        // ...
    }
?>