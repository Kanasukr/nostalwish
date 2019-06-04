<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';
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

// Création de la wishlist
$wishlistPdo = new wishlistPDO();
$wishlist = $wishlistPdo->create(new Wishlist());

// Ajout de la wishlist au personnage
$characterPdo->addWishlist($_GET['character_id'],$wishlist->getId());

header("Location: /wishlist.php?character_id=".$_GET['character_id']);
die();

?>