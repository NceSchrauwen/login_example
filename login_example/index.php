<?php 
//http://localhost/login_example/login.php
//http://localhost/phpmyadmin/ -- users db
//Working example of a login and sign up page linked to MariaDB

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>

	<a href="logout.php">Logout</a>


	<h1>This is the index page</h1>

	<br> Hello, <?php echo $user_data['usr_name']; ?>
	<br> Your id =  <?php echo $user_data['usr_id']; ?>

	<?php 
	$value = '2';


	if($user_data['usr_id'] == $value)
	{
		echo '<button type="button">Edit user rights</button>';
	} else 
	{
		echo '<style> .button-class { display: none; } </style>';
	}


	?>
</body>
</html>