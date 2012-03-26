<?php
// A small utility file for the admin to create a user
// THIS FILE SHOULD NEVER BE PUBLICALLY ACCESSABLE

require_once 'includes/users.php';
require_once 'includes/db.php';


$email = 'wilk0146@algonquinlive.com';
$password = 'password';

user_create($db, $email, $password);

$email = 'bradlet@algonquin.com';
$password = 'password';

user_create($db, $email, $password);










