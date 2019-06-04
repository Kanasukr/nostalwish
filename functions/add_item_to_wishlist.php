<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/item.class.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

if(!isset($_GET['item_name']) || !isset($_GET['wishlist_id']) || !isset($_GET['character_id'])) {
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

// Ajout de l'item à la wishlist
$wishlistPdo = new wishlistPDO();
$wishlistPdo->addItem($_GET['wishlist_id'],$item->getId());

header("Location: /wishlist.php?character_id=".$_GET['character_id']);
die();

?>