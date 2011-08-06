<?php 

function admin_reg()
{
	$user = $_GET["user"];
	$pass = sha1($_GET["password"]);
	$sql = "INSERT INTO user(username,password) VALUES ('" . mysql_real_escape_string($user) . "','" . mysql_real_escape_string($pass) . "')";
	query_database($sql);
}
?>
