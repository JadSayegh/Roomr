<?php

require "user.php";
#tests: 1)correct email/code and user gets activated 2)email doesnt exist 3) email code is wrong 4)user already activated 

if(isset($_GET['email'], $_GET['email_code'])){
    
    
    $email_code = trim($_GET['email_code']);
    $email = trim($_GET['email']);
    
    #check if the email exists
    if(email_exists($email) == false){
        #TODO: log error
    }else if(activate_user($email, $email_code) == false ){
        #TODO: log error "Problem activating account"
        
    }
    
    #check if they are already activated 
    
    
    
}else{
    echo 'BAD URL';
    #exit();
}


?>