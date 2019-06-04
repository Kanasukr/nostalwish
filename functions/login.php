<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/accountpdo.class.php';

if(empty($_POST['account_name']) || empty($_POST['account_password'])) {
	echo "Erreur : paramètres manquants";
	die();
}

$accountPdo = new AccountPDO();
$account = $accountPdo->login($_POST['account_name'],$_POST['account_password']);

if($account->getId() !== null) {
	$_SESSION['account_name'] = $account->getName();
}

header("Location: /");
die();

?>