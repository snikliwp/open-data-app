<?php
	require_once '../includes/filter-wrapper.php';
	
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (empty($id)) {
	header('Location: ../admin.php');
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
header('Location: ../admin.php');
exit;






?>