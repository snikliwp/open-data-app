<?php 
	require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

// When using ->query(), the results variable isn't a real array, its an iterable object
//  Therefore, after the first loop has completed, it isn't being reset to the start
// By calling the ->fetchAll() method on the variable, we get a real array, and can loop multiple times.
$stmt = $db->query('SELECT id, name, longitude, latitude, address 
				FROM gardens 
				ORDER BY name ASC');
$results = $stmt->fetchAll();
?>

<!DOCTYPE HTML>
<html>
<head>
<!--	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
-->	<meta charset="utf-8">
	<title>Gardens</title>
	<link href="css/public.css" rel="stylesheet">
	<script type="text/javascript"
		src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAN6BT9K7vBTXbTaGnTsqF3jQIy_Q7rpV0&sensor=false">
	</script>
	<script type="text/javascript">
		var map
		function initialize() {
			var myOptions = {
			center: new google.maps.LatLng(45.401, -75.692),
			zoom: 10,
			mapTypeId: google.maps.MapTypeId.HYBRID
			};
		map = new google.maps.Map(document.getElementById("map_canvas"),
		myOptions);
		afterInit();
		};
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src= "js/open-data-app.js"></script>
</head>

	<body onload="initialize()">
	<body>
	<div class="grid-row clearfix">
			<div class="grid-unit grid-unit-single">
			<div class="menu">
				<h2>Gardens</h2>
				<table class='main'>
					<tbody>
					<nav>
								<?php foreach ($results as $garden) : ?>
								<?php echo '<tr> <td>' ?>
								 <a href="single.php?id=<?php echo $garden['id'];?>"><?php  echo $garden['name']; ?> </a>
								<?php echo '</td> </tr>' ?>
								<?php endforeach ?>
					</nav>
					</tbody>
				</table>
			</div> <!-- end class menu -->
		</div> <!-- end class grid-unit-single -->


	
	
		<div class="grid-unit grid-unit-triple">
			<a href="admin.php"><button class="add">Admin Login</button></a>
			<br>
			<div id="map_canvas" ></div>
				<script type="text/javascript">
					function afterInit() {
					<?php foreach ($results as $garden) : ?>
						setMarker(<?php echo $garden['latitude'];?>, <?php echo $garden['longitude'];?>, "<?php echo $garden['name'];?>");
					<?php  endforeach ?>
					} // end function afterInit
				</script>
		</div>	<!-- end class grid-unit-triple -->	
	</div>	<!-- end class grid-row -->	


</body>
</html>