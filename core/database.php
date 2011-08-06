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
	
	$sql = sprintf("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '%s' AND table_name = '%s'", DB_NAME, mysql_real_escape_string('user'));
	$ref = mysql_query($sql);

	$result = mysql_result($ref, 0);
	if($result == 0)
	{
		$sql = "CREATE TABLE user (uid INT UNIQUE AUTO_INCREMENT, first_name VARCHAR(50), last_name VARCHAR(50), username VARCHAR(100), password VARCHAR(200), college VARCHAR(100), email VARCHAR(200), access INT, status INT)";
		$ref = mysql_query($sql);
		$result = mysql_result($ref,0);
	
		$sql = "CREATE TABLE page (pid INT UNIQUE AUTO_INCREMENT, title VARCHAR(50), summary VARCHAR(200), content VARCHAR(1000), link VARCHAR(200), next INT)";
		$ref = mysql_query($sql);
		$result = mysql_result($ref,0);
		
		$sql = "CREATE TABLE blocks(bid INT UNIQUE AUTO_INCREMENT, region VARCHAR(50), pages VARCHAR(100), title VARCHAR(100), content VARCHAR(500), next INT)";
		$ref = mysql_query($sql);
		$result = mysql_result($ref,0);
		
		$sql = "CREATE TABLE history(pid INT, uid INT, time INT)";
		$ref = mysql_query($sql);
		$result = mysql_result($ref,0);
		
		$sql = "CREATE TABLE session(uid INT, ssid BIGINT UNSIGNED, browser VARCHAR(100), ip VARCHAR(20), time INT)";
		$ref = mysql_query($sql);
		$result = mysql_result($ref,0);
	
		$sql = "CREATE TABLE config(settings VARCHAR(50), value VARCHAR(50))";
		$ref = mysql_query($sql);
		$result = mysql_result($ref,0);

		require_once("firstreg.php");		
		admin_reg();
	}
}

/*function lets you perform database option by providing it with the sql query
it would return the row*/

function query_database($sql)
{
	$ref = mysql_query($sql);
	$row = mysql_fetch_assoc($ref);
	return $row;
}

?>
