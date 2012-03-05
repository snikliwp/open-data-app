<?php 
	require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

$results = $db->query('SELECT id, name, xcoord, ycoord 
				FROM openDataApp 
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
	<!-- colgroup element allows us to semantically group columns and apply css to a column -->
			<tbody>
		<?php foreach ($results as $museum) : ?>
		 <tr><td>
		 <a href="single.php?id=<?php echo $museum['id'];?>"><?php  echo $museum['name']; ?> </a>
		 </td><td>
		<a href="edit.php?id=<?php echo $museum['id'];?>">Edit</a>
		 </td><td>
		<a href="delete.php?id=<?php echo $museum['id'];?>">Delete</a>
		</td>
		 <?php endforeach ?>
</nav>
			</tbody>
		</table>

	<a href="add.php"><button class="add">Add a New Museum</button></a>

</body>
</html>