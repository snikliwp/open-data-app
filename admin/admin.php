<?php 
	require_once '../includes/filter-wrapper.php';
	
require_once '../includes/users.php';
if(!user_is_signed_in()){
	header('location: sign-in.php');
	exit;
}


require_once '../includes/db.php';

$results = $db->query('SELECT id, name, longitude, latitude, address 
				FROM gardens 
				ORDER BY name ASC');
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Gardens</title>
	<link href="../css/public.css" rel="stylesheet">
</head>

<body>
<h2>Admin Page</h2>
	<a href="add.php"><button class="add">Add a New Garden</button></a>
	<a href="sign-out.php"><button class="logout">Logout</button></a>

<div class="titles">
	<ul>
		<li>Name</li>
		<li>Longitude</li>
		<li>Delete Record</li>
		<li>Edit Record</li>
	</ul>
</div>
<div class="menu2">
	<table>
		<tbody>
		<?php foreach ($results as $garden) : ?>
			 <tr><td>
			 <p><?php  echo $garden['name']; ?> </p>
			 </td><td>
			<p><?php echo $garden['longitude'];?></p>
			 </td><td>
			<p><?php echo $garden['latitude'];?></p>
			</td>
			 </td><td>
			<p><?php echo $garden['address'];?></p>
			 </td><td>
			 <a href="delete.php?id=<?php echo $garden['id'];?>"><?php  echo 'Delete Record'; ?> </a>
			 </td><td>
			 <a href="edit.php?id=<?php echo $garden['id'];?>"><?php  echo 'Edit Record'; ?> </a>
			</td></tr>
		 <?php endforeach ?>
		</tbody>
	</table>
</div>

</body>
</html>