<?php

require("dbConnect.php");

	$username = ($_POST['username']);
	//$email = ($_POST['email']);
	$password = ($_POST['password']);

function checkExistance($database, $user, $password){
	
		$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$password'";
		$result = $database->query($sql);
		if ($result->num_rows == 0){
			return false;
		}
		else{		
			return true;
		}

	}

	if(checkExistance($db, $username, $password)){
			$sql = "UPDATE users SET login = 1 WHERE username = '$username'";
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			else{
				session_start();
				$_SESSION['username'] = $username;
			//	$_SESSION['email'] = $email;
				$_SESSION['login'] = "1";
				echo "pass";
			}
			
	}
	else{
			echo "USER DOES NOT EXISTS";
	}
	
	$db->close();
?>
