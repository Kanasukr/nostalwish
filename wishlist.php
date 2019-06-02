<?php 

header('Content-Type: text/html; charset=UTF-8'); 
require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/wishlistpdo.class.php';

$wishlistId = 1;

if(isset($_GET['wishlist_id'])) {
	$wishlistId = $_GET['wishlist_id'];
}

// Récupération de la wishlist
$wishlistPdo = new wishlistPDO();
$wishlist = $wishlistPdo->get($wishlistId);

// Récupération des items de la wishlist
$wishlistItems = $wishlistPdo->getItems($wishlistId);

?>
<html>
<head>
	<title>Wishlist</title>
</head>
<body>
	<h1>Wishlist</h1>
	<?php if($wishlist->getId() !== null) { 
			if(!(empty($wishlistItems))) { ?>
				<ul id="wishlistItems">
			<?php foreach ($wishlistItems as $key => $wishlistItem) { ?>
					<li><a href="#"><?php echo $wishlistItem->getName(); ?></a></li>		
			<?php } ?>
				</ul>
		<?php } else { ?>
				<p>La wishlist est vide.</p>	
		<?php } ?>
		<input id="searchItem" type="text" name="search" placeholder="Recherche">
		<input type="hidden" name="wishlistId" id="wishlistId" value=<?php echo '"'.$wishlist->getId().'"'; ?>>
		<ul id="searchResults"></ul>
		<img id="spinner" src="img/spinner.gif" style="display: none;">
	<?php } else { ?>
		<p>Aucune wishlist n'existe.</p>
		<a href="functions/create_wishlist.php">En créer une ?</a>
	<?php } ?>
	<script type="text/javascript" src="js/search_item_in_nostalgeek.js"></script>
</body>
</html>