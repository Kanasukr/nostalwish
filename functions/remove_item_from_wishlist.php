<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

if(!isset($_GET['item_id']) || !isset($_GET['wishlist_id']) || !isset($_GET['character_id'])) {
	echo "Erreur : paramètres manquants";
	die();
}

// Suppression de l'item
$itemPdo = new ItemPDO();
$itemPdo->delete($_GET['item_id']);

// Suppression de l'item de la wishlist
$wishlistPdo = new wishlistPDO();
$wishlistPdo->removeItem($_GET['wishlist_id'],$_GET['item_id']);

header("Location: /wishlist.php?character_id=".$_GET['character_id']);
die();

?>