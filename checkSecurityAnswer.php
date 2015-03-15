<?php
    // Get user who is currently logged on
    require("dbConnect.php");

    session_start();
    $username = $_SESSION['username'];
    //$result = $db->query($requestUDB);
    
    $inputAnswer = $_POST['answer'];

    $requestPDB = "SELECT id FROM users WHERE username = '$username'";
    $result = $db->query($requestPDB)or die("failed to retrieve userid..");
        
       
    $resultArray =  mysqli_fetch_assoc($result);
    $user_id = $resultArray['id'];

    $question = "";
    $requestPDB = "SELECT answer FROM user_question WHERE user_id = '$user_id'";
    $result = $db->query($requestPDB) or die("failed to retrieve security answer...");

    if($result->num_rows != 0){
        $resultArray = $result->fetch_assoc();
        $answer= $resultArray['answer'];
        
        if($answer == $inputAnswer){
            echo "success";   
        }else{
            echo "bad answer :  $inputAnswer +  instead of  $answer";   
        }
    }
    $db->close();

?>