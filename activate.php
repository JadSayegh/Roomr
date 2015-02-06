<?php

require ("dbConnect.php");
require ("user.php");
#tests: 1)correct email/code and user gets activated 2)email doesnt exist 3) email code is wrong 4)user already activated 

if(isset($_GET['email'], $_GET['email_code'])){
        
    $email_code = trim($_GET['email_code']);
    $email = trim($_GET['email']);
    
    #check if the email exists
    if(!checkActivation($email, $email_code, $db)){
        echo '[ERROR]: invalid email/activation code combination';
    }else{
        $sql  = "UPDATE users SET activated = 1 WHERE email = '$email' AND email_code = '$email_code'";  
		
		if($result = $db->query($sql)){
			echo 'Activation was successful';
		}
    }
}else{
    echo 'BAD URL';
    #exit();
}


function checkActivation($email, $email_code, $database){
    
	if(!email_exists($email, $database)){
	        return false;
	}else{
        $sql = "SELECT email FROM users WHERE email = '$email' AND email_code = '$email_code'";
		$result = $database->query($sql);
        if($result && $result->num_rows == 1){
			echo " checkActivation success";
           return true;  
        }
		echo " chekACtivation failed!";
        return false;
    }
}

?>