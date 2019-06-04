<?php

require_once '../config.php';
require_once SITE_ROOT.'/classes/account.class.php';
require_once SITE_ROOT.'/classes/pdo/accountpdo.class.php';

if(empty($_POST['account_name']) || empty($_POST['account_password']) || empty($_POST['account_email'])) {
	echo "Erreur : paramètres manquants";
	die();
}

$account = new Account();
$account->setName($_POST['account_name']);
$account->setEmail($_POST['account_email']);
$account->setPassword($_POST['account_password']);
$accountPdo = new AccountPDO();

if($accountPdo->getByName($account->getName())->getId() !== null 
|| $accountPdo->getByEmail($account->getEmail())->getId() !== null ) {
	echo "Erreur : le nom du compte est déjà pris ou l'email est déjà utilisée";
	die();
} 

$accountPdo->create($account);

header("Location: /");
die();

?>