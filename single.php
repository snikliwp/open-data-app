<?php 
/**
 * This file displays a single record from the data base and also lets the
 * user rate the gargen displayed
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

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (empty($id)) {
	header('Location: index.php');
	exit;
};

// you only need to connect to the database if the id is not empty
require_once 'includes/db.php';

// prepare() creates a stored procedure 
$sql = $db->prepare('
	SELECT id, name, longitude, latitude, address, response, count 
		FROM gardens 
		WHERE id = :id
');


$sql->bindValue(':id', $id, PDO::PARAM_INT);

// executes the stored procedure
$sql->execute();
// gets the results from the query and put it into the variable
// fetch() is for one result
// fetchAll is if we expect more than one result
$results = $sql->fetch();

if (empty($results)) {
	header('Location: index.php');
	exit;
};

$cookie = get_rate_cookie();

include 'includes/theme-top.php';

?>

<title><?php echo $results['name'];?> &middot; Garden</title>
<script type="text/javascript">
	var map
	function initialize() {
		var myOptions = {
		center: new google.maps.LatLng(<?php echo $results['latitude'];?>, <?php echo $results['longitude'];?>),
		zoom: 17,
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	map = new google.maps.Map(document.getElementById("smap"),
	myOptions);
	afterInit();
	};
</script>
</head>

<body onLoad="initialize()">
	<div class="masthead">
		<h1><?php echo $results['name'];?></h1>
		<h2><?php echo $results['address'];?></h2>
	</div> <!-- end class masthead -->
	<div id="smap"></div>
		<script type="text/javascript">
			function afterInit() {
				setMarker(<?php echo $results['latitude'];?>, <?php echo $results['longitude'];?>, "<?php echo $results['name'];?>", <?php echo $results['id'];?> );
				} // end function afterInit
		</script>
	</div>	<!-- end class smap -->
	
<?php if (isset($cookie[$id])) : ?>
	
	<div class="rate">
		<p>You have already rated this site as:</p>
		<div class="stars">
			 <ul id="garden-<?php echo $results['id'];?>" class="garden">
				 <li class="star1 ">★</li>
				 <li class="star2 ">★</li>
				 <li class="star3 ">★</li>
				 <li class="star4 ">★</li>
				 <li class="star5 ">★</li>
			 </ul>
			 <script>
			 	setStars(<?php echo $results['id'];?>, <?php echo $results['response'];?>, <?php echo $results['count'];?>);
			 </script>
			<br>
		</div><!-- end class stars -->
	</div>	<!-- end class rate -->
	
	<?php else : ?>
	
	<div class="rate">
		<p>Select the rating you wish to accord this site.</p>
		<div class="setup">
			<ul class="">
				<li>Poor........Average...Excellent</li>
				<li>1 ..... 2 ..... 3 ..... 4 ..... 5</li>
			</ul>
		</div>	<!-- end class setup -->
		<div class="stars">
			 <ul id="garden-<?php echo $results['id'];?>">
				 <li class="star1 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=1">★</a></li>
				 <li class="star2 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=2">★</a></li>
				 <li class="star3 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=3">★</a></li>
				 <li class="star4 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=4">★</a></li>
				 <li class="star5 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=5">★</a></li>
			 </ul>
			<br>
		</div><!-- end class stars -->
	</div>	<!-- end class rate -->
		<?php 
//			$back = 'Location: single.php?id=' + $results['id'];
//			var_dump($back);
//			header("Location: $back");
//	//		header( echo 'Location: single.php?id=' + echo $results['id'];);
//			exit;
		?>
	<?php endif ?>


	<div class="return">
		<a href="index.php">RETURN</a>
	</div>
<?php

include 'includes/theme-bottom.php';

?>
