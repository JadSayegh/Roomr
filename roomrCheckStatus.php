<?php

require("dbConnect.php");

	
	session_start();
	$username = ($_SESSION['username']);
	
function userExists($database, $user){
		
		$sql = "SELECT * FROM users WHERE username = '$user'";
		$result = $database->query($sql);
		
		if($result->num_rows == 0){
			return false;
		}
		else{		
			return true;
		}

}	
	
	
	if(userExists($db, $username)){
		$sql = "SELECT activated FROM users WHERE username = '$username'";
		$result = $db->query($sql);
		if($result == true){
			$activateValue = $result->fetch_row();
			if($activateValue[0] == 1){
				echo "activated";
			}
			else echo "not activated";
		}
		else{
			echo "not activated";
		}
	}
	else{
		echo "USER DOES NOT EXIST";
	}
	$db->close();
?>