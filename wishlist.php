<?php 

header('Content-Type: text/html; charset=UTF-8'); 
require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/characterpdo.class.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

if(!isset($_GET['character_id'])) {
	echo "Erreur : requête incorrecte";
	header("Location: /");
	die();
}

// Récupération du personnage
$characterPdo = new CharacterPDO();
$character = $characterPdo->get($_GET['character_id']);

if($character->getId() == null) {
	echo "Erreur : requête incorrecte";
	header("Location: /");
	die();
}

// Récupération de la wishlist associée 
$wishlist = $characterPdo->getWishlist($_GET['character_id']);

// Si elle existe
if($wishlist->getId() !== null) {
	
	// Récupération des items de la wishlist
	$wishlistPdo = new WishlistPDO();
	$wishlistItems = $wishlistPdo->getItems($wishlist->getId());
}

?>
<html>
<head>
	<title>Wishlist</title>
</head>
<body>
	<h1>Wishlist</h1>
	<?php
		if($wishlist->getId() !== null) { 
			if(!(empty($wishlistItems))) { ?>
				<ul id="wishlistItems">
			<?php foreach ($wishlistItems as $key => $wishlistItem) { 
				$wishlistItemPriceCupper = $wishlistItem->getPrice()%100;
				$wishlistItemPriceSilver = floor(($wishlistItem->getPrice()%10000)/100);
				$wishlistItemPriceGold = floor($wishlistItem->getPrice()/10000);
				?>
					<li>
						<a href="#"><?php echo $wishlistItem->getName(); ?></a> - 
						Prix souhaité : <?php echo $wishlistItemPriceGold."po ".$wishlistItemPriceSilver."pa ".$wishlistItemPriceCupper."pc"; ?> - 
						<a href=<?php echo '"functions/remove_item_from_wishlist.php?item_id='.$wishlistItem->getId().'&wishlist_id='.$wishlist->getId().'&character_id='.$character->getId().'"'?>>Supprimer</a>
					</li>		
			<?php } ?>
				</ul>
		<?php } else { ?>
				<p>La wishlist est vide.</p>	
		<?php } ?>
		<input id="searchItem" type="text" name="search" placeholder="Recherche">
		<input type="hidden" name="wishlistId" id="wishlistId" value=<?php echo '"'.$wishlist->getId().'"'; ?>>
		<input type="hidden" name="characterId" id="characterId" value=<?php echo '"'.$character->getId().'"'; ?>>
		<ul id="searchResults"></ul>
		<img id="spinner" src="img/spinner.gif" style="display: none;">
	<?php } else { ?>
		<p>Aucune wishlist n'existe.</p>
		<a href=<?php echo '"functions/create_wishlist.php?character_id='.$character->getId().'"'?>>En créer une ?</a>
	<?php } ?>
	<script type="text/javascript" src="js/search_item_in_nostalgeek.js"></script>
</body>
</html>