<?php

require("dbConnect.php");

$email = ($_POST['email']);

$password = rand(0, 9999999999999999);

if(checkUnique($db,$email)){
			
				#TODO: add activation and email_code to DB
				$sql = "INSERT into users (username, email, password, login, email_code, activated) VALUES ('$email', '$email', '$password', 0, 1, 1)";
				if(!$result = $db->query($sql)){
					die('There was an error running the query [' . $db->error . ']');
				}
				else{
					$sql = "SELECT id FROM users WHERE email = '$email'";
					$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
					$resultValue = $result->fetch_row();
					$user_id = $resultValue[0];
					
					session_start();
					$_SESSION['username'] = $email;
					$_SESSION['email'] = $email;
					$_SESSION['login'] = "1";
					$_SESSION['userid'] = $user_id;
					$_SESSION['most_recent_activity'] = time();
					
					echo "success";
					echo "userid";
					echo $user_id;
				
					
				}
				
		}
	else{
				$sql = "UPDATE users SET login = 1 WHERE email = '$email'";
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			
			else{
				session_start();
				$sql = "SELECT username, id FROM users WHERE email = '$email'";
				$result = $db->query($sql);
				$resultValue = $result->fetch_row();
				$username = $resultValue[0];
				$user_id = $resultValue[1];
				
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['login'] = "1";
				$_SESSION['userid'] = $user_id;
				$_SESSION['most_recent_activity'] = time();
				echo "success";
			}
		}
		
		$db->close();
	


function checkUnique($database, $email){
		
		$sql = "SELECT * FROM users WHERE email = '$email' ";
		$result = $database->query($sql);
		
		if($result->num_rows == 0){
			return true;
		}
		else{		
			return false;
		}
}
?>