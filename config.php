<?php
	// Check and define Global variables
	if(!defined('DB_DRIVER'))
	{
		define('DB_DRIVER', 'mysqli');
	}
	if(!defined('DB_HOSTNAME'))
	{
		define('DB_HOSTNAME', 'localhost');//replace with your hostname
	}
	if(!defined('DB_USERNAME'))
	{
		define('DB_USERNAME', 'DB_USERNAME');//replace with your database username
	}
	if(!defined('DB_PASSWORD'))
	{
		define('DB_PASSWORD', 'DB_PASSWORD');//replace with your database password
	}
	if(!defined('DB_DATABASE'))
	{
		define('DB_DATABASE', 'DATABASE_NAME');//replace with your database name
	}
	if(!defined('DB_PORT'))
	{
		define('DB_PORT', '3306');
	}

	$siteroot = "http://example.com/";//replace with your hostname
	$siteowner = "BabaChemist";//replace with your sitename or biller name

	$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	mysqli_set_charset($con,"utf8");
	
	//Check session and start if not started
    	if(session_status() == PHP_SESSION_NONE)
    	{
	    session_start();
	}

?>
