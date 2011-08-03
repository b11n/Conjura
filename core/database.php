<?php 
/*
This file creates the connect to the database with the configurations
stored in the config.php file. If the database does not exist then the
new database is created.
*/	

	require_once("config.php");

function database_connect()
{
	$result = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	$database = DB_NAME;
	@mysql_select_db($database) or die( "Unable to select database. Please see if the database exists");
	
}


?>
