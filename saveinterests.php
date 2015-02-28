<?php
header('Content-type: text/html; charset=utf-8');
require 'dbConnect.php';
		
		session_start();
		
		$username = $_SESSION['username'];
		$sql = "SELECT id FROM users WHERE username = '$username'";
		$result = $db->query($sql);
		$resultValue = $result-> fetch_row();
		
		$user_id= resultValue[0]; 
		//get form data
		$interests = json_decode($_GET['interests']);
		$length = count($interests);
		
		//delete existing user interests
		$query = mysqli_query($db, "SELECT * FROM user_interests WHERE user_id = $user_id");
		if ($query){
			if (mysqli_num_rows($query) == 0){
				//echo "No results found.";
			} else {
				$delete =  mysqli_query($db, "DELETE FROM user_interests WHERE user_id = $user_id") or die(mysqli_error());
			}
		} else {
			echo mysqli_error();
		}
		//update with the new user interests
		for($i=0; $i < $length; $i++){
			if ($interests[$i] != 0){
				$insert =  mysqli_query($db, "INSERT INTO user_interests (user_id, interest_id) VALUES ($user_id, $interests[$i])") or die(mysqli_error());
			}
		}
        
        echo "ok";
             
    ?>