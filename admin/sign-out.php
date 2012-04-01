<?php
/**
 * This file logs the user out of the application and 
 * removes his access privileges to the admin pages
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

include_once '../includes/users.php';
user_sign_out();
header('Location: ../index.php');
exit





?>
