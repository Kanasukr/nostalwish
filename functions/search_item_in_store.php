<?php 

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/storepdo.class.php';

// Recherche d'items dans les magasins
$storePdo = new storePDO();
$storeItems = $storePdo->searchItemsByName($_POST['item_name']);
$storeItemsArray = [];

foreach ($storeItems as $key => $storeItem) {
	$storeItemsArray[] = $storeItem->toArray();
}

$storeItemsJson = json_encode($storeItemsArray);
echo $storeItemsJson;

?>