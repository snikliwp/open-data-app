<?php 
	require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

$results = $db->query('SELECT id, name, longitude, latitude, address 
				FROM museums 
				ORDER BY name ASC');
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Museums</title>
	<link href="css/public.css" rel="stylesheet">
</head>

<body>
		<table border="1">
<!--	The caption element briefly describes the contents of the table -->
		<caption>Museums</caption>
	<!--	Header Rows of the table describe each of the columns -->
			<thead>
				<tr>
					<th scope="col" class='name'>Name</th>
					<th scope="col" class='latitude'>Latitude</th>
					<th scope="col" class='longitude'>Longitude</th>
					<th scope="col" class='address'>Address</th>
				</tr>
			</thead>
	<!-- colgroup element allows us to semantically group columns and apply css to a column -->
			<tbody>
		<?php foreach ($results as $museum) : ?>
		 <tr><td>
		 <a href="single.php?id=<?php echo $museum['id'];?>"><?php  echo $museum['name']; ?> </a>
		 </td><td>
		<a href=""><?php echo $museum['longitude'];?></a>
		 </td><td>
		<a href=""><?php echo $museum['latitude'];?></a>
		</td>
		 </td><td>
		<a href=""><?php echo $museum['address'];?></a>
		</td>
		 <?php endforeach ?>
</nav>
			</tbody>
		</table>

	<a href="admin/add.php"><button class="add">Add a New Museum</button></a>
	<a href="admin/delete.php"><button class="add">Delete a New Museum</button></a>
	<a href="admin/edit.php"><button class="add">Edit a New Museum</button></a>

</body>
</html>