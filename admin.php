<?php 
	require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

$results = $db->query('SELECT id, name, longitude, latitude, address 
				FROM gardens 
				ORDER BY name ASC');
?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Gardens</title>
	<link href="css/public.css" rel="stylesheet">
</head>

<body>
<h2>Admin Page</h2>
	<a href="admin/add.php"><button class="add">Add a New Garden</button></a>
	<a href="list.php"><button class="logout">Logout</button></a>


		<table border="3">
<!--	The caption element briefly describes the contents of the table -->
		<caption>Gardens</caption>
	<!--	Header Rows of the table describe each of the columns -->
			<thead>
				<tr>
					<th scope="col" class='name'>Name</th>
					<th scope="col" class='latitude'>Latitude</th>
					<th scope="col" class='longitude'>Longitude</th>
					<th scope="col" class='address'>Address</th>
					<th scope="col" class='address'>Delete Record</th>
					<th scope="col" class='address'>Edit Record</th>
				</tr>
			</thead>
	<!-- colgroup element allows us to semantically group columns and apply css to a column -->
			<tbody>
		<?php foreach ($results as $garden) : ?>
		 <tr><td>
		 <a ><?php  echo $garden['name']; ?> </a>
		 </td><td>
		<a><?php echo $garden['longitude'];?></a>
		 </td><td>
		<a><?php echo $garden['latitude'];?></a>
		</td>
		 </td><td>
		<a><?php echo $garden['address'];?></a>
		 </td><td>
		 <a href="admin/delete.php?id=<?php echo $garden['id'];?>"><?php  echo 'Delete Record'; ?> </a>
		 </td><td>
		 <a href="admin/edit.php?id=<?php echo $garden['id'];?>"><?php  echo 'Edit Record'; ?> </a>
		</td>
		 <?php endforeach ?>
</nav>
			</tbody>
		</table>

</body>
</html>