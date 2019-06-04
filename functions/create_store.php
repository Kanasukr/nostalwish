<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/storepdo.class.php';
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

// Création du magasin
$storePdo = new storePDO();
$store = $storePdo->create(new Store());

// Ajout du magasin au personnage
$characterPdo->addStore($_GET['character_id'],$store->getId());

header("Location: /store.php?character_id=".$_GET['character_id']);
die();

?>