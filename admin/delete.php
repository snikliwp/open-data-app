<?php
/**
 * This file deletes a record form the database
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/

	require_once '../includes/filter-wrapper.php';

	require_once '../includes/users.php';
	if(!user_is_signed_in()){
		header('location: sign-in.php');
		exit;
	}
	
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (empty($id)) {
	header('Location: admin.php');
	exit;
};

// you only need to connect to the database if the id is not empty
require_once '../includes/db.php';

// prepare() creates a stored procedure 
$sql = $db->prepare('
	DELETE FROM gardens
	WHERE id = :id
	LIMIT 1
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);

$sql->execute();
header('Location: admin.php');
exit;






?>