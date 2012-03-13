<?php 

	require_once 'includes/filter-wrapper.php';
	require_once 'includes/db.php';
// $places_xml = simplexml_load_file('data\2010_museums.kml');
$places_xml = simplexml_load_file('data\community-gardens.kml');

$sql = $db->prepare('
	INSERT INTO gardens (name, longitude, latitude, address)
	VALUES (:name, :longitude, :latitude, :address)
	');

foreach ($places_xml->Document->Folder[0]->Placemark as $place) { 
$coords = explode(',',trim($place->Point->coordinates));
$addr = '';
foreach ($place->ExtendedData->SchemaData->SimpleData as $civic) {
	
if ($civic->attributes()->name == "LEGAL_ADDR") { 
	$addr = $civic;
//	var_dump($addr);
	}
}
	$sql->bindvalue(':name', $place->name, PDO::PARAM_STR);
	$sql->bindvalue(':longitude', $coords[0], PDO::PARAM_STR);
	$sql->bindvalue(':latitude', $coords[1], PDO::PARAM_STR);
	$sql->bindvalue(':address', $addr, PDO::PARAM_STR);
	$sql->execute();
//
}
//
 echo ' All Done ';
//
//
// to debug SQL errors
// var_dump($sql->errorInfo());

?>
