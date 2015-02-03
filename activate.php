<?php

require "user.php";
#tests: 1)correct email/code and user gets activated 2)email doesnt exist 3) email code is wrong 4)user already activated 

if(isset($_GET['email'], $_GET['email_code'])){
    
    
    $email_code = trim($_GET['email_code']);
    $email = trim($_GET['email']);
    
    #check if the email exists
    if(checkActivation($email, $email_code)){
        echo '[ERROR]: invalid email/activation code combination';
    }else{
        $sql  = "UPDATE USER SET activated=1 WHERE email = " . $email." AND email_code = ".$email_code;     
        echo 'Activation was successful';
    }
}else{
    echo 'BAD URL';
    #exit();
}


function checkActivation($email, $email){
    if(!email_exists($email)){
        return false;
    }else{
        $sql = "SELECT email FROM users WHERE email = '$email' AND email_code = '$email_code'";
        if($result = $db->query($sql) && $result->num_rows == 1){
           return true;  
        }
        return false;
    }
}

?>