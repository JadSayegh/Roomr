<?php

require("dbConnect.php");
    
    
	$username = ($_POST['username']);
	//$email = ($_POST['email']);
	$password = ($_POST['password']);
    $remember = ($_POST['remember']);

	if(checkExistance($db, $username, $password)){
			$sql = "UPDATE users SET login = 1 WHERE username = '$username'";
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			else{
                
                //Code to remember (or not) the user login
                $year = time() + 31536000;
				if($remember == 1) {
                    setcookie('remember_me_username', $username, $year);
                    setcookie('remember_me_password', $password, $year);
                    setcookie('remember_me', true, $year);
                }elseif(!$remember) {
                   if(isset($_COOKIE['remember_me_username']) &&  isset($_COOKIE['remember_me_password'])) {
                      $past = time() - 100;
                    setcookie('remember_me', "gone", $past);
                    setcookie('remember_me_username', "gone", $past);
    
                    setcookie('remember_me_password', "", $year);
                    setcookie('remember_me_password', "gone", $past);
	               }
                }      

                
				session_start();
				$sql = "SELECT email, id FROM users WHERE username = '$username'";
				$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
                $result_array = $result->fetch_assoc();
                $email = $result_array['email'];
                $user_id = $result_array['id'];
				
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['login'] = "1";
				$_SESSION['userid'] = $user_id;
				
				echo "pass";
				echo "userid";
				echo $user_id;
			}
			
	}
	else{
			echo "USER DOES NOT EXISTS";
	}
	
	$db->close();


function checkExistance($database, $user, $password){
	   
		$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$password'";
		$result = $database->query($sql);
		#TODO: check for null results
        if ($result->num_rows == 0){
			return false;
		}
		else{		
			return true;
		}

	}


?>
