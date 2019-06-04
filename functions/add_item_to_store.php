<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/item.class.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/storepdo.class.php';

if(!isset($_GET['item_name']) || !isset($_GET['store_id']) || !isset($_GET['character_id'])) {
	echo "Erreur : paramètres manquants";
	die();
}

// Création de l'item
$item = new Item();
$item->setName($_GET['item_name']);
$item->setRarity('common');
$item->setPrice(1);
$itemPdo = new ItemPDO();
$item = $itemPdo->create($item);

// Ajout de l'item au magasin
$storePdo = new storePDO();
$storePdo->addItem($_GET['store_id'],$item->getId());

header("Location: /store.php?character_id=".$_GET['character_id']);
die();

?>