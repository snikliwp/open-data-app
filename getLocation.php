<?php 
/**
 * This file gets the users location and store it as a cookie
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/


require_once 'includes/filter-wrapper.php';
require_once 'includes/functions.php';


// you only need to connect to the database if the id is not empty
// require_once 'includes/db.php';

// prepare() creates a stored procedure 


?>

	<div class="innermasthead">
		<h1>Get User Location</h1>
	</div> <!-- end class masthead -->
	
	<div class="geo-form">
		<button id="geo">Find Me</button>
		<form id="geo-form">
			<label for="adr">Address</label>
			<input id="adr">
		</form>
	</div>
	
