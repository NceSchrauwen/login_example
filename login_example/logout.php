<?php

session_start();

if(isset($_SESSION['usr_id']))
{
	unset($_SESSION['usr_id']);

}

header("Location: login.php");
die;

?>