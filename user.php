<?php

#tests: 1) activate a non activated user with email and email_code correct=>true 2)email is wrong => false 3) email_code is wrong 4) user already activated 
function activate_user($email, $email_code){
    #TODO: stub
    echo "\nTried to activate the user\n";

    return false;
}


#tests: 1) email exists 2) email doesnt exist
function email_exists($email){
    #TODO: stub
    
    $sql = "SELECT email FROM users WHERE email = '$email'";
    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
	}else if($result->num_rows == 0){
        echo "\nEmail doesn't exists\n";
        return false;
    
    }
    
    echo "\nEmail exists\n";
    return true;
}

#DEPRECATED
#tests: 1) all is good 2) check that activated is false at the end 3)username already exists 4) email already exists 5) check that there is a email_code identical to the one sent
function register_user($username, $password, $name, $email){

    #TODO:stub
    return false;
}

?>
