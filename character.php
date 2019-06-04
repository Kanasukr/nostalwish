<?php 

header('Content-Type: text/html; charset=UTF-8'); 

require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/characterpdo.class.php';

if(!isset($_GET['character_id'])) {
	echo "Erreur : requête incorrecte";
	header("Location: /");
	die();
}

$characterPdo = new CharacterPDO();
$character = $characterPdo->get($_GET['character_id']);

if($character->getId() == null) {
	echo "Erreur : requête incorrecte";
	header("Location: /");
	die();
}

?>
<html>
<head>
	<title><?php echo $character->getName(); ?></title>
</head>
<body>
	<h1><?php echo $character->getName(); ?></h1>
	<p>Race : <?php echo $character->getRace(); ?></p>
	<p>Classe : <?php echo $character->getClass(); ?></p>
	<p>Niveau : <?php echo $character->getLevel(); ?></p>
	<?php
	if (isset($_SESSION['account_name'])) { ?>
		<p>Identifié en tant que <?php echo $_SESSION['account_name']; ?></p><a href="functions/logout.php">Déconnexion</a>
    	<p>Que souhaitez-vous faire ?</p>
		<div id="action">
			<a href=<?php echo '"buy.php?character_id='.$character->getId().'"'; ?>>Acheter</a><br>
			<a href=<?php echo '"sell.php?character_id='.$character->getId().'"'; ?>>Vendre</a>
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