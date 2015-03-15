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

    $question = "";
    $requestPDB = "SELECT question_id FROM user_question WHERE user_id = '$user_id'";
    $result = $db->query($requestPDB) or die("failed to retrieve security question id...");
    if($result->num_rows != 0){
        $resultArray = $result->fetch_assoc();
        $question_id= $resultArray['question_id'];


        $requestPDB = "SELECT question FROM questions WHERE question_id = '$question_id'";
        $result = $db->query($requestPDB) or die("failed to retrieve security question...");
        
        if($result->num_rows != 0){
            $resultArray = $result->fetch_assoc();
            $question= $resultArray['question'];
        }
    }
    echo $question;

    $db->close();                                    
?>