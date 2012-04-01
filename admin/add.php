<?php 
/**
 * This file adds a new garden to the database
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/
	require_once '../includes/filter-wrapper.php';

	require_once '../includes/users.php';
	if(!user_is_signed_in()){
		header('location: sign-in.php');
		exit;
	}



$errors = array();
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(empty($name)) {
		$errors['name'] = true;
	}
	if(empty($latitude)) {
		$errors['latitude'] = true;
	}
	if(empty($longitude)) {
		$errors['longitude'] = true;
	}
	if(empty($address)) {
		$errors['address'] = true;
	}
	if(empty($errors)) {
	require_once '../includes/db.php';
	$sql = $db-> prepare('
		INSERT INTO gardens (name, latitude, longitude, address)
		VALUES (:name, :latitude, :longitude, :address)
		');

	$sql->bindValue(':name', $name, PDO::PARAM_STR);
	$sql->bindValue(':latitude', $latitude, PDO::PARAM_STR);
	$sql->bindValue(':longitude', $longitude, PDO::PARAM_STR);
	$sql->bindValue(':address', $address, PDO::PARAM_STR);
	$sql->execute();
	
	header('Location: admin.php');
	exit;
	}
	
}
include '../includes/admin-theme-top.php';

?>


<title>Add a Garden</title>
</head>
	<div class="masthead">
		<h1>Add a New Garden Record</h1>
	</div> <!-- end class masthead -->

<body>
<div class="addgarden">
<form class= "adgarden" method="post" action="add.php">
	<div class="name">
		<label for="name">Garden Name     </label>
		<input type="text" id="name" name="name" value="" required><span> (*)</span>
	</div>
	<div class="address">
		<label for= "address">Garden Address  </label> 
		<input type="date" id="address" name="address" value="" required><span> (*)</span>
	</div>
	<div class="latitude">
		<label for="latitude">Garden Latitude </label>
		<input type="text" id="latitude" name="latitude" value="" required><span> (*)</span>
	</div>
	<div class="longitude">
		<label for= "longitude">Garden Longitude</label>
		<input type="date" id="longitude" name="longitude" value="" required><span> (*)</span>
	</div>
	<button type="submit">Add</button>
	<a href="admin.php"><button class="cancel">Cancel</button></a>
</form>
<br>
<strong>(*) is Required</strong>
</div> <!-- end class addgarden -->

</body>
</html>