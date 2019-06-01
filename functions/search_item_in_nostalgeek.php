<?php 

require_once '../config.php';
require_once SITE_ROOT.'/classes/item.class.php';

$name = $_POST['name'];

$url = 'https://www.nostalgeek-serveur.com/db/?search='.$name.'#items';

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'GET'
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {
	echo "Erreur : impossible d'importer les données.";
}

// Isolement de l'intérieur de la balise js contenant les résultats
preg_match('/<div id="topbar">.*\n\t*<script.*>(.*)g_spells.*<\/script>/', $result, $rawContent);
$rawItemNames = preg_replace("/.*g_initHeader.*g_items(.*)/", '$1', $rawContent[1]);

// Ajout d'une newline pour chaque point-virgule
$rawItemNamesWithNewlines = str_replace(";", "\n", $rawItemNames);

// Récupération des noms d'item
$itemNamesWithNewlines = preg_replace("/.*_\[.*\]={.*name_frfr:'(.*)'}.*\n*/", '$1;', $rawItemNamesWithNewlines);
$itemNames = explode(";", $itemNamesWithNewlines);

// Filtre des résultats pour correspondre à la recherche
$filteredItemNames = [];
foreach ($itemNames as $key => $itemName) {
	if(stripos($itemName, $name) !== false) {
    	$filteredItemNames[] = $itemName;
	}
}

// Création de l'array d'items
$itemsArray = [];
foreach ($filteredItemNames as $key => $filteredItemName) {
	$item = new Item();
	$item->setName($filteredItemName);
	$itemsArray[] = $item->toArray();
}

// Conversion en JSON
$itemsJson = json_encode($itemsArray);
echo $itemsJson;

?>