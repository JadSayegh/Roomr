<?php

require("dbConnect.php");

if (!session_id()) {
	session_start();
	
	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
		$sql = "Update users  SET login = 0 WHERE username = '$user'";
			
		if(!$result = $db->query($sql)){
						die('There was an error running the query [' . $db->error . ']');
		}
		else{
			session_unset(); 
			session_destroy();
			echo "success";
			
		}
	}
	else echo "success";

}

else echo "success";
	
?>	