<?php 
	header('Content-Type: text/html; charset=UTF-8'); 

	require_once __DIR__ . '/config.php';

	echo SITE_ROOT;

	/*require_once 'classes/pdo/itempdo.class.php';

	$itemPdo = new ItemPDO();

	$item = new Item();

	$item->setName('Bottes de Sancteforge');
	$item->setRarity('rare');
	$item->setPrice(68444);

	$itemPdo->create($item);*/

?>
<html>
<head>
	<title>Nostalwish</title>
</head>
<body>
	<h1>Nostalwish</h1>
	<p>Items et magasins pour le serveur NostalGeek</p>
	<p>Que souhaitez-vous faire ?</p>
	<div id="action">
		<a href="buy.php">Acheter</a><br>
		<a href="sell.php">Vendre</a>
	</div>
</body>
</html>