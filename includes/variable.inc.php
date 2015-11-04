<?php
define("HOST", "mysql1.000webhost.com");
define("DBNAME", "a8773318_acebedo");
define("DBUSER", "a8773318_acebedo");
define("PWD", "Dublin2013");
	   
	   $dbc=0;
	   
	   $dbc = mysqli_connect(HOST, DBUSER, PWD, DBNAME)
	   	or die ('Cannot connect to database');
	   
	   define("SITE_ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
	   
	   define("USER_UPLOAD_DIR", "/PHP_ASSIGNMENT_L4/uploads/");
	   
	   define("MAX_UPLOAD_SIZE", 50*1025);
	   
	   ?>