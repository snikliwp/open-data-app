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
				
include '../includes/admin-theme-top.php';

?>


</head>

<body>
	<div class="masthead">
		<h1>Admin Page</h1>
	</div> <!-- end class masthead -->

	<div class="options">
		<a href="add.php"><button class="buttonadd">Add a New Garden</button></a>
		<a href="add-admin.php"><button class="logout">Add a New Administrator</button></a>
		<a href="sign-out.php"><button class="logout">Logout</button></a>
	</div>  <!-- end class options -->

<div class="titles">
	<ul>
		<li class="name">Name</li>
		<li class="lat">Latitude</li>
		<li class="long">Longitude</li>
		<li class="add">Address</li>
		<li class="del">Delete Record</li>
		<li class="edit">Edit Record</li>
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