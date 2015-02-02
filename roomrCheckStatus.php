<?php

require("dbConnect.php");

	

	$username = ($_POST['username']);
	
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
		$sql = "SELECT activated FROM users WHERE username = '$user'";
		$result = $database->query($sql);
		if($result == true){
			echo "activated";
		}
		else{
			echo "not activated";
		}
	}
	else{
		echo "USER DOES NOT EXIST";
	}
	
?>