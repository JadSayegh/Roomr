
<?php
    session_start();
    
   
    require "dbConnect.php";
	
    #TODO: check whether the session variable has something in it from login. 
    $username = $_SESSION["username"];
    if(!$username) $username = $_SESSION["username"];
	#WHAT IS THIS LINE AND THE ABOVE LINE FOR?
	if( isset($_POST['username']) ){
		$username = $_POST['username'];
	}
    #$email = $_SESSION["email"];
    

    $userID = $_SESSION["userid"];

    #need to change here and below
    $sql = "SELECT favourite_id from user_favourites WHERE user_id = '$userID'";
        
    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
	}else if($result->num_rows == 0){
		var_dump($result);
        echo "ERROR: This profile does not have any favourites. \n";
    }

    //$result_array = mysqli_fetch_all($result);
    $finalArray = array(array("favoriteID"=>"", "username"=>""));
    $i=0;
    
    
    
    while($favoriteID = $result->fetch_assoc()){
        $favoriteIDValue = $favoriteID['favourite_id'];
        $otherSQL = "SELECT username from users WHERE id = '$favoriteIDValue'";
        $favouritedUsername = $db->query($otherSQL);
        
        $finalArray[$i]["favoriteID"] = $favoriteIDValue;
        $preprocessedUsername = $favouritedUsername->fetch_assoc();
        $finalArray[$i]["username"] = $preprocessedUsername['username'];
        $i++;   
    }



    
    echo json_encode($finalArray);

    
?>
