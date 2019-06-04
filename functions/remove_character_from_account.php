<?php 

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/characterpdo.class.php';
require_once SITE_ROOT.'/classes/pdo/accountpdo.class.php';

if(!isset($_GET['account_id']) || !isset($_GET['character_id'])) {
	echo "Erreur : paramètres manquants";
	die();
}
	
// Suppression du personnage
$characterPdo = new CharacterPDO();
$characterPdo->delete($_GET['character_id']);

// Suppression du personnage du compte
$accountPdo = new AccountPDO();
$accountPdo->removeCharacter($_GET['account_id'],$_GET['character_id']);

header("Location: /");
die();

?>