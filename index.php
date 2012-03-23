<?php 
	require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

// When using ->query(), the results variable isn't a real array, its an iterable object
//  Therefore, after the first loop has completed, it isn't being reset to the start
// By calling the ->fetchAll() method on the variable, we get a real array, and can loop multiple times.
$stmt = $db->query('SELECT id, name, longitude, latitude, address, response, count 
				FROM gardens 
				ORDER BY name ASC');
$results = $stmt->fetchAll();

include 'includes/theme-top.php';
?>

	<title>Gardens</title>
	<script type="text/javascript">
		var map
		function initialize() {
			var myOptions = {
			center: new google.maps.LatLng(45.401, -75.692),
			zoom: 13,
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
			<table class='main'>
				<tbody>
					<nav>
						<?php foreach ($results as $garden) : ?>
							<?php echo '<tr><td>' ?>
							<a href="single.php?id=<?php echo $garden['id'];?>"><?php  echo $garden['name']; ?> </a>
							 <?php echo '</td><td>'?>
							 <ul id="garden-<?php echo $garden['id'];?>" class="garden">
								 <li class="star1 ">★</li>
								 <li class="star2 ">★</li>
								 <li class="star3 ">★</li>
								 <li class="star4 ">★</li>
								 <li class="star5 ">★</li>
							 </ul>
							 <script>setStars(<?php echo $garden['id'];?>, <?php echo $garden['response'];?>, <?php echo $garden['count'];?>);
							 </script>
							 <?php echo '</td><td>'?>
							<a href="rate.php?id=<?php echo $garden['id'];?>">Rate</a>
							 <?php echo '</td></tr>'?>
						<?php endforeach?>
					</nav>
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
				</script>
		</div>	<!-- end class map-->
	</div>	<!-- end class page -->	
	<footer>
		<div class="admin">
			<a href="admin.php"><button class="add">Admin Login</button></a>
		</div> <!-- end class admin -->
	</footer>
<?php

include 'includes/theme-bottom.php';

?>
