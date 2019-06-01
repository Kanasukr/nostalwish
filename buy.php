<?php 

header('Content-Type: text/html; charset=UTF-8');
require_once 'config.php';

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
		<a href="wishlist.php">Ajouter sur une wishlist ?</a>
	</span>
	<script type="text/javascript" src="/js/search_item_in_store.js"></script>
</body>
</html>