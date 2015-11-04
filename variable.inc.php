<?php
define("HOST"
define("DBNAME",
define("DBUSER",
define("PWD",
	   
	   $dbc=0;
	   
	   $dbc = mysqli_connect(HOST, DBUSER, PWD, DBNAME)
	   	or die ('Cannot connect to database');
	   
	   define("SITE_ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
	   
	   define("USER_UPLOAD_DIR", "/PHP_ASSIGNMENT_L4/uploads/");
	   
	   define("MAX_UPLOAD_SIZE", 50*1025);
	   
	   ?>