<?php
/**
 * This file adds a new administrator id to the database
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

require_once '../includes/users.php';
require_once '../includes/db.php';
require_once '../includes/filter-wrapper.php';

if(!user_is_signed_in()) {
		header('location: sign-in.php');
	exit;
}
$errors = array();
$email = '';
$password = '';
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = true;
	}
	if (empty($password)) {
		$errors['password'] = true;
	}
	if (empty($errors)) {
		$user = user_get($db, $email);
		if (empty($user)) {
			user_create($db, $email, $password);
			$errors['user-is-empty'] = true;
		}
//		header('Location: admin.php');
//		exit;
	}

}
$results = $db->query('SELECT email 
				FROM users 
				ORDER BY email ASC');

include '../includes/admin-theme-top.php';

?>


<title>Add Admin</title>
</head>

<body>
	<div class="masthead">
		<h1>Add a New Admin User</h1>
	</div> <!-- end class masthead -->

<div class="login">
<form method="post" action="add-admin.php">
	<div class="email">
		<label for="email">Email Address</label>
		<input type="email" id="email" name="email" required>
	</div> <!-- end div email -->
	<div class="password">
		<label for="password">Password</label>
		<input type="password" id="password" name="password" required>
	</div> <!-- end div password -->
	<div class="button">
		<button type="submit">Add User</button>
		<a href="admin.php"><button>Finished</button></a>
	</div> <!-- end div button -->
</form>
</div> <!-- end div login -->
<div class="exist">
<h3>Exisiting Administrators</h3>
	<ul>
		<?php foreach ($results as $email) : ?>
			 <li><?php  echo $email['email']; ?> </li>
		 <?php endforeach ?>
	</ul>
</div>



</body>
</html>