<?php 

header('Content-Type: text/html; charset=UTF-8'); 

require_once '../config.php';
require_once SITE_ROOT.'/classes/character.class.php';
require_once SITE_ROOT.'/classes/pdo/characterpdo.class.php';
require_once SITE_ROOT.'/classes/pdo/accountpdo.class.php';

if(!isset($_GET['account_id']) && !isset($_POST['account_id'])) {
	echo "Erreur : requête incorrecte";
	header("Location: /");
	die();
}

if(!empty($_POST)) {
	if(!isset($_POST['character_name']) || !isset($_POST['character_race'])
	|| !isset($_POST['character_class']) || !isset($_POST['character_level'])) {
		echo "Erreur : paramètres manquants";
		die();
	}
	
	$characterPdo = new CharacterPDO();

	if($characterPdo->getByName($_POST['character_name'])->getId() !== null) {
		echo "Erreur : personnage déjà existant";
		die();
	}

	// Création du personnage
	$character = new Character();
	$character->setName($_POST['character_name']);
	$character->setRace($_POST['character_race']);
	$character->setClass($_POST['character_class']);
	$character->setLevel($_POST['character_level']);
	$character = $characterPdo->create($character);

	// Ajout du personnage au compte
	$accountPdo = new AccountPdo();
	$accountPdo->addCharacter($_POST['account_id'],$character->getId());

	header("Location: /");
	die();
}

?>
<html>
<head>
	<title>Nouveau personnage</title>
</head>
<body>
	<h1>Ajouter un nouveau personnage</h1>
	<form id="add_character_to_account" method="POST">
		<input type="text" name="character_name" placeholder="Nom du personnage">
		<input type="text" name="character_race" placeholder="Race du personnage">
		<input type="text" name="character_class" placeholder="Classe du personnage">
		<input type="text" name="character_level" placeholder="Niveau du personnage">
		<input type="hidden" name="account_id" value=<?php echo '"'.$_GET['account_id'].'"' ?>>
		<input type="submit" name="submit" value="Valider">
	</form>
</body>
</html>