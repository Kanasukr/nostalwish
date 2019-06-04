<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

if(!isset($_GET['item_id']) || !isset($_GET['wishlist_id'])) {
	echo "Erreur : paramètres manquants";
	die();
}

$itemId = $_GET['item_id'];
$wishlistId = $_GET['wishlist_id'];

// Suppression de l'item
$itemPdo = new ItemPDO();
$itemPdo->delete($itemId);

// Suppression de l'item de la wishlist
$wishlistPdo = new wishlistPDO();
$wishlistPdo->removeItem($wishlistId,$itemId);

header("Location: /wishlist.php?wishlist_id=".$wishlistId);
die();

?>