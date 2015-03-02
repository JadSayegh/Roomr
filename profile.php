
<?php
    session_start();
    
   
    require "dbConnect.php";
	
    #TODO: check whether the session variable has something in it from login. 
    $username = $_SESSION["username"];
    if(!$username) $username = $_SESSION["username"];
	
	if( isset($_POST['username']) ){
		$username = $_POST['username'];
	}
    #$email = $_SESSION["email"];
    
    $sql = "SELECT id, email FROM users WHERE username = '$username'";
        
    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
	}else if($result->num_rows == 0){
		var_dump($result);
        echo "ERROR: This profile does not exist. \n";
    }

    
    $result_array = mysqli_fetch_assoc($result);

    
    
//    $name = $result_array['name'];
    $email = $result_array["email"];
 //   echo "Name: $name";
    
    
    
    $user_id = $email = $result_array["id"];
    
	
    $sql = "SELECT name FROM interests INNER JOIN user_interests ON interests.id = user_interests.interest_id WHERE user_interests.user_id = '$user_id'";
	
	$json = array();
	array_push($json, $email);
	array_push($json, $username);

    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
	}else if($result->num_rows == 0){
        
    }else{

      
        for($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--){
            $result_array = $result->fetch_assoc();
			array_push($json, $result_array["name"]);
           
        }
		
    }
	echo json_encode($json);
?>
