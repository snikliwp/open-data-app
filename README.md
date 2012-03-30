	Application Summary
	-------------------
	This application provides a list of all community gardens in the city of Ottawa.
	It presents the information in two ways, as a list and as a marker on a map. 
	Selecting either will take the user to a single page where detailed information of the garden is available.
	The list on the index page also provides a visual indication (stars) of the rating of the garden.
	The single page provides a close up map of the garden's location, the address, and any other
	information that may be available in the database. It also provides for the ability to rate the garden.
	The rating is purely subjective with no guidance criteria beyond bad to excellent.
	
	An administrator may log into the system and add, edit or delete garden records through special
	access pages that are protected from unauthorized use.
	It also provides the administrator to add additional administrators to the database.
	
	Installation Instructions
	--------------------------
	This application was originally installed in WAMP.
	The data structure should be installed in the root directory with the subdirectories and their files
	installed as they reside in the repository.
	Beside the default, the following PHP extensions must be turned on:
		php_openssl
	Beside the default, the following Apache modules must be activated:
		rewrite_module
	A database called Gardens must be created.
	in the subdirectory called dbsaves items is a file called gardens.sql. it must be imported into the 
	database. It contains the necessary tables for the database and a user wilk0146 with a password of 'password'
	for access to the administration screens.
	A new database of community garden locations must be downloaded from the Ottawa Open Data site (the file with the kml extension) 
	and placed in the folder called data. The file must be named 'community-gardens.kml'.
	By opening a file called 'loaddata.php', located in the root folder, all the data will be loaded into the database.
	The application should now be ready for use.
	
	Links
	-----
	- Github Repository			https://github.com/snikliwp/mtm1531-open-data-app
	- PHPFOG Repository			git@git01.phpfog.com:gardens.phpfogapp.com
	- PHPFOG Application		http://gardens.phpfogapp.com/index.php
	- Design Brief				http://snikliwp.github.com/mtm1531-open-data-app
	- City of Ottawa Dataset	http://ottawa.ca/online_services/opendata/info/index_en.html#c 
	- Author					wilk0146@algonquinlive.com

	Version
	-------
	1.0.0

	Copyright
	---------
	March 2012 Pat Wilkins

	License
	-------
	
	
	
	