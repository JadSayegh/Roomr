<?php

require("dbConnect.php");
	
	$username = ($_POST['username']);		
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = $db->query($sql);
	//echo $username;
	if($result->num_rows == 0){
		echo 'unique';
	} else{		
		echo 'not unique';
	}
?>
