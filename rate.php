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

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $results['name'];?> &middot; Garden</title>
	<link href="css/public.css" rel="stylesheet">
</head>

<body>
	<h1><?php echo $results['name'];?></h1>
	<p>Address: <?php echo $results['address']; ?></p>
	<p>Select the rating you wish to accord this site.</p>
	 <ul id="garden-<?php echo $results['id'];?>">
		 <li class="star1 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=1">★</a></li>
		 <li class="star2 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=2">★</a></li>
		 <li class="star3 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=3">★</a></li>
		 <li class="star4 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=4">★</a></li>
		 <li class="star5 "><a href="rateupdate.php?id=<?php echo $results['id'];?>&rate=5">★</a></li>
	 </ul>

	
	
	
	
	
	<a href="index.php"><button class="cancel">Cancel</button></a>

</body>
</html>

















