<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "users_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	echo "Db failed to connect.";
	die("Connection failed: " . mysqli_connect_error());

} else 
{
	echo "MySQL database connection established!";
}

