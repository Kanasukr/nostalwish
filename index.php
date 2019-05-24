<?php 
	header('Content-Type: text/html; charset=UTF-8'); 
	include('classes/pdomanager.class.php');

	$pdoManager = new PDOManager();
	$pdoManager->test();
?>
<html>
<head>
	<title>Nostalwish</title>
</head>
<body>
	<h1>Nostalwish</h1>
	<p>Wishlists et magasins pour le serveur NostalGeek</p>
	<p>Que souhaitez-vous faire ?</p>
	<div id="action">
		<a href="buy.php">Acheter</a><br>
		<a href="sell.php">Vendre</a>
	</div>
</body>
</html>