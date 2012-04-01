<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Page Views</title>
</head>

<body>
<?php 
// Track how many times you have viewed this page for this session


session_start();

$_SESSION['page-view'] += 1;


?>
<strong>You have visited this page <?php echo $_SESSION['page-view']; ?> times!</strong>
 

</body>
</html>