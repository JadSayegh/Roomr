<?php

require("dbConnect.php");
    
    
	session_start();
		$username = $_SESSION['username'];
		$sql = "SELECT id from users  WHERE username = '$username'";
		$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
		
		$activateValue = $result->fetch_row();
		$user_id = $activateValue[0];
		echo $user_id;
	checkExistance($user_id);

	/*if(checkIfRequests($db, $username, $password)){
			$sql = "UPDATE users SET login = 1 WHERE username = '$username'";
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			else{
				session_start();
				$sql = "SELECT email FROM users WHERE username = '$username'";
				$result = $db->query($sql);
                $result_array = mysql_fetch_assoc($result)
                $email = $result_array['email'];
                
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['login'] = "1";
				echo "pass";
			}
			
	}
	else{
			echo "USER DOES NOT EXISTS";
	}
	
	$db->close();*/


function checkExistance($user_id){
	  
		$sql = "SELECT * FROM requests WHERE userid = '$user_id'";
		$result = $db->query($sql); //or die('There was an error running the query [' . $db->error . ']');
		#TODO: check for null results
        /*if ($result->num_rows == 0){
			echo "no";
			//return false;
			
		}
		else{	
			echo "yes";	
			//return true;
		}

	}*/
}


?>
