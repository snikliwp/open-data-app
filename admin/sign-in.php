<?php
require_once '../includes/db.php';

require_once '../includes/users.php';

if(user_is_signed_in()) {
	header('Location: admin.php');
	exit;
}
$errors = array();
var_dump($errors);

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
var_dump($email, $password);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = true;
	}
	
	if (empty($password)) {
		$errors['password'] = true;
	}
	
	if (empty($errors)) {
		$user = user_get($db, $email);
		if (!empty($user)) {
			if(passwords_match($password, $user['password'])) {
				user_sign_in($user['id']);
				header('Location: admin.php');
			} else{
			$errors['password-no-match'] = true;
			}
		} else {
			$errors['user-non-existent'] = true;
		}
	}
	
	
}



?>


<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Sign In</title>
</head>

<body>

<form method="post" action="sign-in.php">
	<div>
		<label for="email">Email Address</label>
		<input type="email" id="email" name="email" required>
	</div>
	<div>
		<label for="password">Password</label>
		<input type="password" id="password" name="password" required>
	</div>
	<div>
		<button type="submit">Sign In</button>
	</div>
</form>


</body>
</html>