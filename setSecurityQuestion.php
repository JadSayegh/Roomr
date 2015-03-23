<?php
    // Get user who is currently logged on

require("dbConnect.php");
    
    session_start();
    $username = $_SESSION['username'];
    //$result = $db->query($requestUDB);
    
    $question = $_POST['question'];
    $answer  = $_POST['answer'];
    
    
    $requestPDB = "SELECT id FROM users WHERE username = '$username'";
    $result = $db->query($requestPDB)or die("failed to retrieve userid..");
        
       
    $resultArray =  mysqli_fetch_assoc($result);
    $user_id = $resultArray['id'];

    $requestPDB = "SELECT user_id FROM user_question WHERE user_id = '$user_id'";
    $result = $db->query($requestPDB) or die("failed to retrieve check for security question...");

    $resultArray =  mysqli_fetch_assoc($result);

    if($result->num_rows != 0){
        
        //store which question was asked and what the answer was
        $requestPDB = "UPDATE user_question SET question_id='$question', answer='$answer' WHERE user_id ='$user_id'";
        $result = $db->query($requestPDB) or die("failed to update question..");
        
        //TODO: check that it actually worked
        echo "exists";
        
    }else{
  //      echo "data insert is : ".$answer." and ".$user_id;
        $requestPDB = "INSERT INTO user_question(user_id, question_id, answer) VALUES ('$user_id', '$question', '$answer')";
        $result = $db->query($requestPDB) or die("failed to set question..");
        
        
        echo "success"; 
        
    }

    //table1: question question_id  : question_id question
    //table2: user_question : user_id question_id answer
?>