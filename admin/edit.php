<?php 
	require_once '../includes/filter-wrapper.php';

	require_once '../includes/users.php';
	if(!user_is_signed_in()){
		header('location: sign-in.php');
		exit;
	}


$errors = array();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(empty($id)){
	header('Location: admin.php');
}

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(empty($name)) {
		$errors['longitude'] = true;
	}
	if(empty($longitude)) {
		$errors['longitude'] = true;
	}
	if(empty($latitude)) {
		$errors['latitude'] = true;
	}
	if(empty($address)) {
		$errors['address'] = true;
	}
	if(empty($errors)) {
	require_once '../includes/db.php';
	$sql = $db-> prepare('
		UPDATE gardens 
		SET name= :name, longitude= :longitude, latitude= :latitude, address= :address
		WHERE id =:id
		');
	
	
	$sql->bindValue(':name', $name, PDO::PARAM_STR);
	$sql->bindValue(':longitude', $longitude, PDO::PARAM_STR);
	$sql->bindValue(':latitude', $latitude, PDO::PARAM_STR);
	$sql->bindValue(':address', $address, PDO::PARAM_STR);
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	
	header('Location: admin.php');
	exit;
	}
	
} else {
	
		require_once '../includes/db.php';
		
		// prepare() creates a stored procedure 
		$sql = $db->prepare('
			SELECT id, name, longitude, latitude, address
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
		
			$name = $results['name'];
			$longitude = $results['longitude'];
			$latitude = $results['latitude'];
			$address = $results['address'];
			
			
			
		}

?>





<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Edit A Garden</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>
<form method="post" action="edit.php?id=<?php echo $id; ?>">
	<div class="name">
		<label for="name"> Garden Name <?php if(isset($errors['name'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
	</div>
	<div class="longitude">
		<label for="longitude">Garden Longitude <?php if(isset($errors['longitude'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="text" id="longitude" name="longitude" value="<?php echo $longitude; ?>" required>
	</div>
	<div class="latitude">
		<label for= "latitude">Garden Latitude <?php if(isset($errors['latitude'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="date" id="latitude" name="latitude" value="<?php echo $latitude; ?>" required>
	</div>
	<div class="address">
		<label for= "address">Garden Address <?php if(isset($errors['address'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="date" id="address" name="address" value="<?php echo $address; ?>" required>
	</div>
	<button type="submit">Submit</button>
	
	<a href="admin.php"><button class="cancel">Cancel</button></a>

</form>



</body>
</html>