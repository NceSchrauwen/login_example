<?php

function check_login($con)
{

	if(isset($_SESSION['usr_id']))
	{

		$id = $_SESSION['usr_id'];
		$query = "SELECT * FROM usr_test WHERE usr_id = '$id' LIMIT 1"; //limit to one acc

		$result = mysqli_query($con,$query);
		
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function fetch_id($con)
{
	$sql = "SELECT * FROM usr_test";
	$result = $con->query($sql);

	while($row = $result->mysqli_fetch_assoc())
	{
		echo $row['usr_id'];
	}
}

// function check_num($con){

// 	if(isset($_SESSION['usr_id']))
// 	{
// 		$item = "";

// 		$query2 = "SELECT * FROM usr_test";
// 		$result2 = mysqli_query($con, $query2);

// 		$usr_data = mysqli_fetch_assoc($result2);

// 		foreach($usr_data as $item)
// 		{
// 			$ids[] = $item->usr_id;
// 		}
// 		// $row2 = mysqli_fetch_assoc($result2);
// 		// $rights = $row2['usr_id'];

// 		// if($rights == 76)
// 		// {
// 		// 	echo $rights;
// 		// 	echo '<button>yeesss</button>';
// 		// } else 
// 		// {
// 		// 	echo $rights;
// 		// 	echo "denied";
// 		// }
// 	}
// }