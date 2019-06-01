<?php 

require_once '../config.php';
require_once SITE_ROOT.'/classes/pdo/itempdo.class.php';

$name = $_POST['name'];
$itemPdo = new ItemPDO();
$items = $itemPdo->searchByName($name);
$itemsArray = [];

foreach ($items as $key => $item) {
	$itemsArray[] = $item->toArray();
}

$itemsJson = json_encode($itemsArray);
echo $itemsJson;

?>