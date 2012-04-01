<?php 
/**
 * This file is a program to take the kml data file and load the information
 * contained in it into the database. It is optimized for the community
 * gardens kvm file and may not work with other kvm files
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

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
