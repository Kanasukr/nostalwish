<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/storepdo.class.php';

if(!isset($_GET['item_id']) || !isset($_GET['store_id']) || !isset($_GET['character_id'])) {
	echo "Erreur : paramètres manquants";
	die();
}

// Suppression de l'item
$itemPdo = new ItemPDO();
$itemPdo->delete($_GET['item_id']);

// Suppression de l'item du magasin
$storePdo = new storePDO();
$storePdo->removeItem($_GET['store_id'],$_GET['item_id']);

header("Location: /store.php?character_id=".$_GET['character_id']);
die();

?>