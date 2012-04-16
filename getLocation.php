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
	</div> <!-- end class innermasthead -->
	<div class="instructions">
		<p>You May fill in an address in the address field and press the 'find me' button or you can leave the addrress field blank and press the 'find me' button. If you do the latter, you must confirm that you want Google to determine your location.</p>
	</div>  <!-- end class instructions -->
	<div class="geo-form">
		<form id="geo-form">
			<label for="adr">Address</label>
			<input id="adr">
		</form>
		<button id="geo">Find Me</button>
	<div id="error1"><p id="error"></p></div>
	</div> <!-- end class geo-form -->
	
