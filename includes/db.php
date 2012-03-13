<?php

// this file takes the environmental values created in .htaccess file and sets them into php

$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$dsn = stripslashes(getenv('DB_DSN'));

$db = new PDO($dsn, $user, $pass);
$db->exec('SET NAMES utf8');

var_dump($sql->errorInfo());
