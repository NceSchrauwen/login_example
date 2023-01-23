<?php 
session_start(); //start session

	//include local files to utilize the functions and variables it has
	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//variables were posted
		$usr_name = $_POST['usr_name'];
		$usr_pass = $_POST['usr_pass'];

		//2 = admin, 1 = read only, 0 = no access, wait for permission
		//set to 0 for admin (2) to review his rights as a user and potentially change it
		$usr_id = '2'; 

		//the higher the cost the harder it is to crack the password
		$options = [
			'cost' => 12,
		];

		$hashed = password_hash($usr_pass, PASSWORD_DEFAULT, $options); //hash the password

		//check to see if all fields are filled, also the username cannot be nummeric
		if(!empty($usr_name) && !empty($usr_pass) && !is_numeric($usr_name))
		{
			//save to database
			$query = "INSERT INTO usr_test (usr_id, usr_name, usr_pass) VALUES (?, ?, ?);";

			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'sss', $usr_id, $usr_name, $hashed);
			mysqli_stmt_execute($stmt);


		} else
		{
			echo "Please enter some valid information!";
		}
	}

	if(isset($_POST['btn_save']))
	{

		header("Location: login.php?alert=true");
		exit; //or die

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

			<input id="usr_name" type="text" name="usr_name" placeholder="usr name"><br><br>
			<input id="usr_pass" type="password" name="usr_pass" placeholder="usr password"><br><br>

			<input type="submit" name = "btn_save" value="Save and redirect" />

			</form>
		</form>
	</div>
</body>
</html>



