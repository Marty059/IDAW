
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SitePro</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <header>
            <h1 class="titre">Martin Delsart</h1>
            <div class="image-container">
                <?php echo"<a href=\"index.php?page={$currentPageId}&lang=fr\"" ?>
                    <img src="../Flag_of_France.png" width="150px" alt="Fr">
                </a>
                <?php echo"<a href=\"index.php?page={$currentPageId}&lang=en\"" ?>
                    <img src="../Flag_of_the_UK.png" width="150px" alt="En">
                </a>
            </div>

            
            


