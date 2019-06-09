<?php

header('Content-Type: text/html; charset=UTF-8'); 

require_once '../config.php';
require_once SITE_ROOT.'/classes/item.class.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

if((!isset($_GET['item_name']) && !isset($_POST['item_name'])) 
|| (!isset($_GET['wishlist_id']) && !isset($_POST['wishlist_id'])) 
|| (!isset($_GET['character_id']) && !isset($_POST['character_id']))) {
	echo "Erreur : paramètres manquants";
	die();
}

if(!empty($_POST)) {
	// Création de l'item
	$item = new Item();
	$item->setName($_POST['item_name']);
	$item->setRarity('common');
	$itemPrice = 10000*intval($_POST['item_price_gold']) + 100*intval($_POST['item_price_silver']) + intval($_POST['item_price_cupper']);
	$item->setPrice($itemPrice);
	$itemPdo = new ItemPDO();
	$item = $itemPdo->create($item);

	// Ajout de l'item au magasin
	$wishlistPdo = new wishlistPDO();
	$wishlistPdo->addItem($_POST['wishlist_id'],$item->getId());

	header("Location: /wishlist.php?character_id=".$_POST['character_id']);
	die();
}

?>
<html>
<head>
	<title>Ajout d'item</title>
</head>
<body>
	<h1>Ajouter un nouvel item</h1>
	<form id="add_character_to_account" method="POST">
		<p>Nom de l'item : <?php echo $_GET['item_name']; ?></p>
		<input type="hidden" name="item_name" value=<?php echo '"'.$_GET['item_name'].'"'; ?>>
		<p>Prix souhaité de l'item :</p>
		<input type="text" name="item_price_gold" placeholder="PO">
		<input type="text" name="item_price_silver" placeholder="PA">
		<input type="text" name="item_price_cupper" placeholder="PC">
		<input type="hidden" name="wishlist_id" value=<?php echo '"'.$_GET['wishlist_id'].'"' ?>>
		<input type="hidden" name="character_id" value=<?php echo '"'.$_GET['character_id'].'"' ?>>
		<input type="submit" name="submit" value="Valider">
	</form>
</body>
</html>