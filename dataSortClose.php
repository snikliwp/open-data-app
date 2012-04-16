<?php 
/**
 * This file displays the list of the open data set sorted by closeness to the user
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

require_once 'includes/filter-wrapper.php';
require_once 'includes/functions.php';
// Check to see if they already have a location

$cookie = get_loc_cookie();

if (!isset($cookie[0])) {
	// it is empty
	//get location
	header('Location: getlocation.php');
	exit;
}else{
	// sort by location
}

require_once 'includes/db.php';

$stmt = $db->query('SELECT id, name, longitude, latitude, address, response, count 
				FROM gardens 
				ORDER BY count / response DESC');
$results = $stmt->fetchAll();
$distances = array();
// var_dump($results);

foreach ($results as $garden) {
	$distances[] = distance($cookie[0], $cookie[1], $garden['latitude'], $garden['longitude'], 'k');
}

asort($distances);

 foreach ($distances as $key=>$distance) : $garden = $results[$key]; ?>
	<?php echo '<tr><td>' ?>
	<a href="single.php?id=<?php echo $garden['id'];?>"><?php  echo $garden['name']; ?> </a>
	 <?php echo '</td><td>'?>
	 <!-- I need an if statement here to either display this in the stars field or a distance if sorted by closest -->
	 <span><?php echo number_format($distance, 1); ?> km</span>
	 <?php echo '</td></tr>'?>
<?php endforeach?>
