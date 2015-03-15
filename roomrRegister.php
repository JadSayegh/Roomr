<?php

require("dbConnect.php");
include("emailActivation.php");
	

	$username = ($_POST['username']);
	$email = ($_POST['email']);
	$password = ($_POST['password']);

    $email_code = md5($username + microtime());
	if(validatePostData($username, $email, $password)){
		if(checkUnique($db, $username, $email)){
			
				#TODO: add activation and email_code to DB
				$sql = "INSERT into users (username, email, password, login, email_code, activated) VALUES ('$username', '$email', '$password', 0, '$email_code', 0)";
				if(!$result = $db->query($sql)){
					die('There was an error running the query [' . $db->error . ']');
				}
				else{
					
					$sql = "SELECT id FROM users WHERE email = '$email'";
					$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
					$resultValue = $result->fetch_row();
					$user_id = $resultValue[0];
					
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION['email'] = $email;
					$_SESSION['login'] = "1";
					$_SESSION['activated'] = "0";
					$_SESSION['userid'] = $userid;
					echo "success";
					
					sendActivationEmail($username, $email, $email_code);
					
				}
				
		}
		else{
				echo "USER OR EMAIL ALREADY EXISTS";
		}
		
		$db->close();
	}

function validatePostData($username, $email, $password){
		
		if(!preg_match('/^(?=.*\d)[0-9A-Za-z!@#$%]{8,16}$/', $password)) {
			echo 'the password does not meet the requirements!';
			return false;
		}
		if(!preg_match('/^(?=.*[A-Za-z])[0-9A-Za-z!@#_.$%-]{8,16}$/', $username)) {
			echo 'the username does not meet the requirements!';
			return false;
		}
		if(!preg_match('/^(?=.*[@])(?=.*[A-Za-z])[0-9A-Za-z!@_.-]{3,50}$/', $email)) {
			echo 'the email does not meet the requirements!';
			return false;
		}	
		return true;
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

