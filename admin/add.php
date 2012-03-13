<?php 
	require_once '../includes/filter-wrapper.php';

$errors = array();
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);


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
	if(empty($errors)) {
	require_once '../includes/db.php';
	$sql = $db-> prepare('
		INSERT INTO gardens (name, latitude, longitude)
		VALUES (:name, :latitude, :longitude)
		');
	
	
	$sql->bindValue(':name', $name, PDO::PARAM_STR);
	$sql->bindValue(':latitude', $latitude, PDO::PARAM_STR);
	$sql->bindValue(':longitude', $longitude, PDO::PARAM_STR);
	$sql->execute();
	
	header('Location: ../admin.php');
	exit;
	}
	
}

?>


<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Add a Garden</title>
	<link href="css/admin.css" rel="stylesheet">
</head>

<body>
<form method="post" action="add.php">
	<div class="name">
		<label for="name"> Garden Name <strong>is Required</strong></label>
		<input type="text" id="name" name="name" value="" required>
	</div>
	<div class="latitude">
		<label for="latitude">Garden Latitude <strong>is Required</strong></label>
		<input type="text" id="latitude" name="latitude" value="" required>
	</div>
	<div class="longitude">
		<label for= "longitude">Garden Longitude  <strong>is Required</strong></label>
		<input type="date" id="longitude" name="longitude" value="" required>
	</div>
	<button type="submit">Add</button>
</form>


</body>
</html>