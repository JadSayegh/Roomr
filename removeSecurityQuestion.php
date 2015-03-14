<?php
    // Get user who is currently logged on

require("dbConnect.php");
    
    session_start();
    $username = $_SESSION['username'];
    //$result = $db->query($requestUDB);
    
    
    $requestPDB = "SELECT id FROM users WHERE username = '$username'";
    $result = $db->query($requestPDB)or die("failed to retrieve userid..");
        
       
    $resultArray =  mysqli_fetch_assoc($result);
    $user_id = $resultArray['id'];

    $requestPDB = "SELECT user_id FROM user_question WHERE user_id = '$user_id'";
    $result = $db->query($requestPDB) or die("failed to retrieve check for security question...");

    $resultArray =  mysqli_fetch_assoc($result);

    if($result->num_rows != 0){
        $requestPDB = "DELETE FROM user_question WHERE user_id = '$user_id'";
    $result = $db->query($requestPDB) or die("failed to retrieve check for security question..."); 
        echo "deleted";
        
    }else{    
        echo "not found";         
    }

?>