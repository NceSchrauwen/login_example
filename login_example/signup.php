<?php 
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$usr_id = $_POST['usr_id'];
		$usr_name = $_POST['usr_name'];
		$usr_pass = $_POST['usr_pass'];

		$options = [
			'cost' => 10,
		];

		$hashed = password_hash($usr_pass, PASSWORD_DEFAULT, $options);
		

		if(!empty($usr_id) && !empty($usr_name) && !empty($usr_pass) && !is_numeric($usr_name))
		{
			//save to database
			$query = "INSERT INTO usr_test ( usr_id, usr_name, usr_pass) VALUES (?, ?, ?);";

			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'iss', $usr_id, $usr_name, $hashed);
			mysqli_stmt_execute($stmt);

			//header("Location: login.php");
			//die;

		} else
		{
			echo "Please enter some valid information!";
		}
	}

	if(isset($_POST['btn_save']))
	{
		// echo "<script type = 'text/javascript'>alert('Wait for user rights or something idk');</script>";

		header("Location: login.php?alert=true");
		exit;

	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="usr_id" placeholder="id"><br><br>
			<input id="text" type="text" name="usr_name" placeholder="usr name"><br><br>
			<input id="text" type="password" name="usr_pass" placeholder="usr password"><br><br>

			<!-- <input id="button" type="submit" value="Signup"><br><br> -->


			<!-- MAKE A POP-UP IN JAVASCRIPT? OR JUST TEXT? IDK PHP CAN'T DO IT -->
			
			<!-- <a href="login.php">Click to Login</a><br><br> -->
			
			<input type="submit" name = "btn_save" value="Save and redirect" />
			<!-- <form action="login.php"> -->

			

			</form>
		</form>
	</div>
</body>
</html>



