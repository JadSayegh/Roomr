<?php

require("dbConnect.php");

	

	$username = ($_POST['username']);
	$email = ($_POST['email']);
	$password = ($_POST['password']);
	
	
	

	
	if($usernameLength> 16 || $usernameLength < 6) 
        
	

	if(checkUnique($db, $username, $email)){
			$sql = "INSERT into users (username, email, password, login) VALUES ('$username', '$email', '$password', 0)";
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			else{
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['login'] = "1";
				echo "success";
			}
			
	}
	else{
			echo "USER OR EMAIL ALREADY EXISTS";
	}
	
	$db->close();


function validatePostData($username, $email, $password){
		
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,16}$/', $password)) {
			echo 'the password does not meet the requirements!';
			return false;
		}
		if(!preg_match('/^(?=.*[A-Za-z])[0-9A-Za-z!@#_-.$%]{8,16}$/', $username)) {
			echo 'the username does not meet the requirements!';
		}
		if(!preg_match('/^(?=.*[@])(?=.*[A-Za-z])[0-9A-Za-z!@_-.]{3,50}$/', $email)) {
			echo 'the email does not meet the requirements!';
		}
	
}

function checkUnique($database, $user, $email){
		
		$sql = "SELECT * FROM users WHERE username = '$user' OR email = '$email' ";
		$result = $database->query($sql);
		
		if($result->num_rows == 0){
			return true;
		}
		else{		
			return false;
		}

}
?>

