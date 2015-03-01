<?php
    // Get user who is currently logged on
    require("dbConnect.php");
  
    //$result = $db->query($requestUDB);
    
    $oldUsername = $_POST['username'];
    $newUsername = $_POST['newUsername'];

    
   session_start();
    $actualUsername= $_SESSION['username'];
	
	if($oldUsername == $actualUsername) {
		
		$sql= "SELECT username FROM users WHERE username = '$newUsername'";
		$result = $db->query($sql);
		if($result->num_rows == 0){
			$requestUserChange = "UPDATE users SET username = '$newUsername' WHERE username = '$oldUsername'";
			$changed = $db->query($requestUserChange);
			$_SESSION['username'] = $newUsername;
			 echo "success"; //$changed;
		}
		else{
			echo "exists";
		}
       
    } else {
        echo "fail";
    }

    $db->close();                                    
?>