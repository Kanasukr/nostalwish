<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/item.class.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

if(!isset($_GET['item_name']) || !isset($_GET['wishlist_id'])) {
	echo "Erreur : paramètres manquants";
	die();
}

$itemName = $_GET['item_name'];
$wishlistId = $_GET['wishlist_id'];

// Création de l'item
$item = new Item();
$item->setName($itemName);
$item->setRarity('common');
$item->setPrice(1);
$itemPdo = new ItemPDO();
$item = $itemPdo->create($item);

// Ajout de l'item à la wishlist
$wishlistPdo = new wishlistPDO();
$wishlistPdo->addItem($wishlistId,$item->getId());

header("Location: /wishlist.php?wishlist_id=".$wishlistId);
die();

?>