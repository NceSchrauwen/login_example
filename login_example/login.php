<?php 

session_start();

	include("connection.php");
	include("functions.php");

	if(isset($_GET['alert']))
	{
		echo "<script type='text/javascript'>alert('Your user data is saved into the database.');</script>";
	} 

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		
		$usr_name = $_POST['usr_name'];
		$plain_pass = $_POST['usr_pass'];

		if(!empty($usr_name) && !empty($plain_pass) && !is_numeric($usr_name))
		{

			//read from database
			$query = "SELECT * FROM usr_test WHERE usr_name = '$usr_name' LIMIT 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					    $user_data = mysqli_fetch_assoc($result);

						// $has_rights = '1';
						// $is_admin = '2';

						$check = '2';

						//hashed check
						$hashed_pass = $user_data['usr_pass'];
						$usr_id = $user_data['usr_id'];

						if(password_verify($plain_pass, $hashed_pass))  
						{
					
							//if the user has not have the sufficient s
							if($usr_id === $check) //$usr_id === $has_rights || $usr_id === $is_admin
							{
								$_SESSION['usr_id'] = $usr_id;
								header("Location: index.php");
								die;
							} else 
							{
								echo 'Insufficient user rights!';
								echo "Your user ID is: " . $usr_id;
							}

							
						} else 
						{
							echo "Wrong password, please enter a valid password.";
						}
					
					
					
				}
			} else 
			{
				echo "wrong username or password!";
			}
			
			
		}else
		{
			echo "wrong username or password!";
		}
	}
	

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="usr_name"><br><br>
			<input id="text" type="password" name="usr_pass"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>

