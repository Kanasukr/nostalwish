<?php 

require_once '../classes/pdo/itempdo.class.php';

$items = array(
	array(
		'id' => 1,
		'name' => 'Tunique de rédemption'
	),
	array(
		'id' => 2, 
		'name' => 'Garde-jambes de rédemption'
	)
);

$itemsJson = json_encode($items);

echo $itemsJson;

?>