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
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src= "js/open-data-app.js"></script>
</head>

	<body>
	<div class="grid-row clearfix">
		<div class="grid-unit grid-unit-triple">
			<div class="menu">
				<h2>Gardens</h2>
				
				<table class='main'>
					<tbody>
					<nav>
						<?php foreach ($results as $garden) : ?>
						 <tr>
							 <td>
								 <a href="single.php?id=<?php echo $garden['id'];?>"><?php  echo $garden['name']; ?> </a>
							 </td>
						</tr>
						<?php endforeach ?>
					</nav>
					</tbody>
				</table>
			</div> <!-- end class menu -->
		</div>	<!-- end class grid-unit-triple -->	
		<div class="grid-unit grid-unit-single">
			<a href="admin.php"><button class="add">Admin Login</button></a>
		</div> <!-- end class grid-unit-single -->
	</div>	<!-- end class grid-row -->	


</body>
</html>