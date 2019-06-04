<?php 

header('Content-Type: text/html; charset=UTF-8');

require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/characterpdo.class.php';

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

?>
<html>
<head>
	<title>Achats</title>
</head>
<body>
	<h1>Achats</h1>
	<input id="searchItem" type="text" name="search" placeholder="Recherche">
	<ul id="searchResults"></ul>
	<span id="wishlistProposal" style="display: none;">
		<p>Cet item n'est pas présent sur les stores.</p>
		<a href=<?php echo '"wishlist.php?character_id='.$character->getId().'"'; ?>>Ajouter sur une wishlist ?</a>
	</span>
	<script type="text/javascript" src="/js/search_item_in_store.js"></script>
</body>
</html>