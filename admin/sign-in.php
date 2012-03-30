<?php
require_once '../includes/db.php';

require_once '../includes/users.php';

if(user_is_signed_in()) {
	header('Location: admin.php');
	exit;
}
$errors = array();

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


include '../includes/admin-theme-top.php';

?>


<title>Sign In</title>
</head>

<body>
	<div class="masthead">
		<h1>Sign In</h1>
	<br>
	</div> <!-- end class masthead -->

<div class="login">
<form method="post" action="sign-in.php">
	<div class="email">
		<label for="email">Email Address</label>
		<input type="email" id="email" name="email" required>
	</div> <!-- end div email -->
	<div class="password">
		<label for="password">Password</label>
		<input type="password" id="password" name="password" required>
	</div> <!-- end div password -->
	<div class="button">
		<button type="submit">Sign In</button>
	</div> <!-- end div button -->
</form>
</div> <!-- end div login -->

</body>
</html>