<?php
	// Check and define Global variables
	if(!defined('DB_DRIVER'))
	{
		define('DB_DRIVER', 'mysqli');
	}
	if(!defined('DB_HOSTNAME'))
	{
		define('DB_HOSTNAME', 'localhost');
	}
	if(!defined('DB_USERNAME'))
	{
		define('DB_USERNAME', 'cmsadmin');
	}
	if(!defined('DB_PASSWORD'))
	{
		define('DB_PASSWORD', 'cmsadmin2015');
	}
	if(!defined('DB_DATABASE'))
	{
		define('DB_DATABASE', 'cms');
	}
	if(!defined('DB_PORT'))
	{
		define('DB_PORT', '3306');
	}

	$siteroot = "http://crescentschool.in/babachemist/";
	$siteowner = "BabaChemist";

	$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	mysqli_set_charset($con,"utf8");
	
	//Check session and start if not started
    if(session_status() == PHP_SESSION_NONE)
    {
	    session_start();
	}

?>