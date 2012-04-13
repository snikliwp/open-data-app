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
// var_dump($results);

 foreach ($results as $garden) : ?>
	<?php echo '<tr><td>' ?>
	<a href="single.php?id=<?php echo $garden['id'];?>"><?php  echo $garden['name']; ?> </a>
	 <?php echo '</td><td>'?>
	 <!-- I need an if statement here to either display this in the stars field or a distance if sorted by closest -->
	 <ul id="garden-<?php echo $garden['id'];?>" class="garden">
		 <li class="star1 ">★</li>
		 <li class="star2 ">★</li>
		 <li class="star3 ">★</li>
		 <li class="star4 ">★</li>
		 <li class="star5 ">★</li>
	 </ul>
	 <script>setStars(<?php echo $garden['id'];?>, <?php echo $garden['response'];?>, <?php echo $garden['count'];?>);
	 </script>
	 <?php echo '</td></tr>'?>
<?php endforeach?>
