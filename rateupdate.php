<?php 
	require_once 'includes/filter-wrapper.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (empty($id)) {
	header('Location: index.php');
	exit;
};
$rate = filter_input(INPUT_GET, 'rate', FILTER_SANITIZE_NUMBER_INT);


// you only need to connect to the database if the id is not empty
require_once 'includes/db.php';

// prepare() creates a stored procedure 
$sql = $db->prepare('
	UPDATE gardens
	SET 
	response=response + 1,
	count= count + :rate 
	WHERE id =:id
		');
	
	
	$sql->bindValue(':rate', $rate, PDO::PARAM_INT);
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	
	header('Location: index.php');
	exit;