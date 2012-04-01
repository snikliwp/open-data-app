<?php 
/**
 * This file displays allows the edit of an existing record in the database
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
include '../includes/admin-theme-top.php';

?>

<title>Edit A Garden</title>
</head>
	<div class="masthead">
		<h1>Edit a Garden Record</h1>
	</div> <!-- end class masthead -->

<body>
<div class="addgarden">
<form method="post" action="edit.php?id=<?php echo $id; ?>">
	<div class="name">
		<label for="name"> Garden Name <?php if(isset($errors['name'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
	</div> <!-- end class name -->
	<div class="longitude">
		<label for="longitude">Garden Longitude <?php if(isset($errors['longitude'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="text" id="longitude" name="longitude" value="<?php echo $longitude; ?>" required>
	</div> <!-- end class longitude -->
	<div class="latitude">
		<label for= "latitude">Garden Latitude <?php if(isset($errors['latitude'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="date" id="latitude" name="latitude" value="<?php echo $latitude; ?>" required>
	</div> <!-- end class latitude -->
	<div class="address">
		<label for= "address">Garden Address <?php if(isset($errors['address'])) : ?> <strong>is Required</strong><?php endif; ?></label>
		<input type="date" id="address" name="address" value="<?php echo $address; ?>" required>
	</div> <!-- end class address -->
	<button type="submit">Submit</button>
	
	<a href="admin.php"><button class="cancel">Cancel</button></a>

</form>
</div> <!-- end class addgarden -->


</body>
</html>