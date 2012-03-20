<?php 
	require_once 'includes/filter-wrapper.php';

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
include 'includes/theme-top.php';

?>

<title><?php echo $results['name'];?> &middot; Garden</title>
<script type="text/javascript">
	var map
	function initialize() {
		var myOptions = {
		center: new google.maps.LatLng(<?php echo $results['latitude'];?>, <?php echo $results['longitude'];?>),
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	map = new google.maps.Map(document.getElementById("smap"),
	myOptions);
	};
	afterload();
</script>
</head>

<body onLoad="initialize()">
	<div class="masthead">
		<h1><?php echo $results['name'];?></h1>
		<h2><?php echo $results['address']; ?></h2>
	</div> <!-- end class masthead -->
	<div id="smap">
		<script type="text/javascript">
		function afterload() {
			setMarker(<?php echo $results['latitude'];?>, <?php echo $results['longitude'];?>, "<?php echo $results['name'];?>", <?php echo $results['id'];?> );
			} // end function afterload
		</script>
	</div>	<!-- end class smap -->
	<a href="index.php"><button class="return">Return</button></a>
<?php

include 'includes/theme-bottom.php';

?>
