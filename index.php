<?php 

header('Content-Type: text/html; charset=UTF-8'); 

require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';

//session_destroy();

?>
<html>
<head>
	<title>Nostalwish</title>
</head>
<body>
	<h1>Nostalwish</h1>
	<p>Items et magasins pour le serveur NostalGeek</p>
	<?php
	if (isset($_SESSION['account_name'])) { ?>
		<p>Identifié en tant que <?php echo $_SESSION['account_name']; ?></p><a href="functions/logout.php">Déconnexion</a>
    	<p>Que souhaitez-vous faire ?</p>
		<div id="action">
			<a href="buy.php">Acheter</a><br>
			<a href="sell.php">Vendre</a>
		</div>
	<?php } else { ?>
		<p>Merci de vous authentifier :</p>
		<form id="login" action="functions/login.php" method="POST">
			<input type="text" name="account_name" placeholder="Nom de compte">
			<input type="password" name="account_password" placeholder="Mot de passe">
			<input type="submit" name="submit" value="Valider">
		</form>
		<p>Pas de compte ? S'enregistrer :</p>
		<form id="register" action="functions/register.php" method="POST">
			<input type="text" name="account_name" placeholder="Nom de compte">
			<input type="text" name="account_email" placeholder="email@hote.fr">
			<input type="password" name="account_password" placeholder="Mot de passe">
			<input type="submit" name="submit" value="Valider">
		</form>
	<?php } ?>
</body>
</html>