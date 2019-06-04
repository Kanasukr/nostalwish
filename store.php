<?php 

header('Content-Type: text/html; charset=UTF-8'); 

require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/characterpdo.class.php';
require_once SITE_ROOT.'/classes/pdo/storepdo.class.php';

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

// Récupération du magasin associé 
$store = $characterPdo->getStore($_GET['character_id']);

// S'il existe
if($store->getId() !== null) {
	
	// Récupération des items du store
	$storePdo = new StorePDO();
	$storeItems = $storePdo->getItems($store->getId());
}

?>
<html>
<head>
	<title>Vente</title>
</head>
<body>
	<h1>Vente</h1>
	<?php 
		if($store->getId() !== null) { 
			if(!(empty($storeItems))) { ?>
				<ul id="storeItems">
			<?php foreach ($storeItems as $key => $storeItem) { ?>
					<li>
						<a href="#"><?php echo $storeItem->getName(); ?></a> - 
						<a href=<?php echo '"functions/remove_item_from_store.php?item_id='.$storeItem->getId().'&store_id='.$store->getId().'&character_id='.$character->getId().'"'?>>Supprimer</a>
					</li>		
			<?php } ?>
				</ul>
		<?php } else { ?>
				<p>Le magasin est vide.</p>	
		<?php } ?>
		<input id="searchItem" type="text" name="search" placeholder="Recherche">
		<input type="hidden" name="storeId" id="storeId" value=<?php echo '"'.$store->getId().'"'; ?>>
		<input type="hidden" name="characterId" id="characterId" value=<?php echo '"'.$character->getId().'"'; ?>>
		<ul id="searchResults"></ul>
		<img id="spinner" src="img/spinner.gif" style="display: none;">
	<?php } else { ?>
		<p>Aucun magasin n'existe.</p>
		<a href=<?php echo '"functions/create_store.php?character_id='.$character->getId().'"'?>>En créer un ?</a>
	<?php } ?>
	<script type="text/javascript" src="js/search_item_in_nostalgeek.js"></script>
</body>
</html>