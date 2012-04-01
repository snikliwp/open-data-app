<?php
/**
 * This file links environmental variables set up through the .htaccess file
 * and sets them into php
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

// this file takes the environmental values created in .htaccess file and sets them into php

$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$dsn = stripslashes(getenv('DB_DSN'));

$db = new PDO($dsn, $user, $pass);
$db->exec('SET NAMES utf8');

