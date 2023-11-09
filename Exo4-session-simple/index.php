<?php
	session_start();

	if(isset($_GET['disconnect'])) {
		session_unset();
		session_destroy();
		unset($_GET['disconnect']);
	}

	$username = "Anonymous";
	$is_connected = False;

	if(isset($_SESSION['login'])) {
		$username = $_SESSION['login'];
		$is_connected = True;
	}

	if(isset($_POST['login'])) {
		$username = $_POST['login'];
		// session_start();
		$_SESSION['login'] = $username;
		$is_connected = True;
	}

    $pageToInclude = 'accueil';
    $mymenu = [ "accueil", "cv", "hobbies" ];
    if(isset($_GET['page'])) {
		if(in_array($_GET['page'],$mymenu,TRUE))
			$pageToInclude = $_GET['page'];
    }

    function renderCurrentMenuEntry($pageId, $currentPageId){
        if($pageId==$currentPageId)
            echo ' class="selected"';
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Luc Fabresse</title>
	<link rel="stylesheet" href="styles/simple.css" title="test" charset="utf-8" />

 </head>
  <body>

    <div class="page">

<header class="bandeau_haut">

	<?php if (!$is_connected): ?>
		<form id="login_form" action="index.php" method="POST">
			<table>
				<tr>
					<th>Login :</th>
					<td><input type="text" name="login"></td>
				</tr>
				<tr>
					<th>Mot de passe :</th>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="submit" value="Se connecter..." /></td>
				</tr>
			</table>
		</form>
		</div>

	<?php else: ?>

		<h1 class="titre">Hello <?php echo $username; ?></h1>
		<div id="style_form">
			<a href="index.php?disconnect">Logout</a>
		</div>

	<?php endif ?>

</header>

<!-- menu -->
<nav class="menu">
    <a <?php renderCurrentMenuEntry($pageToInclude,'accueil'); ?> href='index.php?page=accueil'>Accueil</a>
    <a <?php renderCurrentMenuEntry($pageToInclude,'cv'); ?> href='index.php?page=cv'>Cv</a>
    <a <?php renderCurrentMenuEntry($pageToInclude,'hobbies'); ?> href='index.php?page=hobbies'>Mes Hobbies</a>
</nav>

<section class="corps">
	<?php require_once("pages/$pageToInclude.php"); ?>
</section>

<div class="div-min-height"> </div>

<div class="pied">
    Site réalisé en PHP+HTML+CSS
</div>
</div>
</body>
</html>