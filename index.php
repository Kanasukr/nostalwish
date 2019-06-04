<?php 

header('Content-Type: text/html; charset=UTF-8'); 

require_once 'config.php';
require_once SITE_ROOT.'/classes/pdo/accountpdo.class.php';

$accountPdo = new AccountPDO();

?>
<html>
<head>
	<title>Nostalwish</title>
</head>
<body>
	<h1>Nostalwish</h1>
	<p>Items et magasins pour le serveur NostalGeek</p>
	<?php
	if (isset($_SESSION['account_name'])) {
		require_once SITE_ROOT.'/account_banner.php'; ?>
		
		<p>Liste des personnages :</p>

		<?php 

		// Récupération du compte et des personnages associés
		$account = $accountPdo->getByName($_SESSION['account_name']);
		$accountCharacters = $accountPdo->getCharacters($account->getId());

		if(!(empty($accountCharacters))) { ?>
			<ul id="accountCharacters">
		<?php foreach ($accountCharacters as $key => $accountCharacter) { ?>
				<li>
					<a href=<?php echo '"character.php?character_id='.$accountCharacter->getId().'"'; ?>><?php echo $accountCharacter->getName(); ?></a> - 
					<a href=<?php echo '"functions/remove_character_from_account.php?character_id='.$accountCharacter->getId().'&account_id='.$account->getId().'"'; ?>>Supprimer</a>
				</li>		
		<?php } ?>
			</ul>
		<?php } else { ?>
				<p>Aucun personnage.</p>
		<?php } ?>
			<a href=<?php echo '"functions/add_character_to_account.php?account_id='.$account->getId().'"'; ?>>Ajouter</a>
	<?php } else { require_once SITE_ROOT.'/login_register_menu.php'; } ?>
</body>
</html>