<?php 
/**
 * This file displays the list and map of the open data set
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
require_once 'includes/functions.php';

// here I want to see what the sort order is and pass that out to a function to sort it
$sortType = filter_input(INPUT_POST, 'sort', FILTER_SANITIZE_STRING);
// var_dump('Sort Type', $sortType);

//// When using ->query(), the results variable isn't a real array, its an iterable object
////  Therefore, after the first loop has completed, it isn't being reset to the start
//// By calling the ->fetchAll() method on the variable, we get a real array, and can loop multiple times.
//$stmt = $db->query('SELECT id, name, longitude, latitude, address, response, count 
//				FROM gardens 
//				ORDER BY name ASC');
//$results = $stmt->fetchAll();


include 'includes/theme-top.php';
get_loc_cookie () 

?>

	<title>Gardens</title>
	<script type="text/javascript">
		var map
		function initialize() {
			var myOptions = {
			center: new google.maps.LatLng(45.401, -75.692),
			zoom: 11,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			};
		map = new google.maps.Map(document.getElementById("map_canvas"),
		myOptions);
		afterInit();
		};
	</script>
</head>

<body onLoad="initialize()">
	<div class="masthead">
		<h1>Ottawa Community Gardens</h1>
	</div> <!-- end Class Masthead -->
	<div class="page">
		<div class="menu">
			<table >
				<tbody class='main'>
					<?php require 'dataSortAlpha.php'; ?>
				</tbody>
			</table>
		</div> <!-- end class menu -->
		<div class="map">
			<div id="map_canvas" class="map_can" ></div>
				<script type="text/javascript">
					function afterInit() {
					<?php foreach ($results as $garden) : ?>
						setMarker(<?php echo $garden['latitude'];?>, <?php echo $garden['longitude'];?>, "<?php echo $garden['name'];?>", <?php echo $garden['id'];?> );
					<?php  endforeach ?>
					} // end function afterInit
//					set_user_location(<?php //$location[0] ?>, <?php //$location[1] ?>);
				</script>
		</div>	<!-- end class map-->
	</div>	<!-- end class page -->	
	<footer>
		<div class="sortData">
			<form id="sortForm">
				<label for="sortFormLabel">Sort</label>
				<select id="sortFormID" name="sortFormID">
					<option selected value="alpha">Alphabetically</option>
					<option value="rate">Rating</option>
					<option value="close">Closest</option>
				</select>
					<button id="sortButton">Sort</button>
			</form>
		</div> <!-- end class sortData -->
		<div class="admin">
			<a href="admin/admin.php"><button class="add">Admin Login</button></a>
		</div> <!-- end class admin -->
		
	</footer>
<?php

include 'includes/theme-bottom.php';

?>
