<?php

require("dbConnect.php");
    
    
	session_start();
		$id = $_SESSION['userid'];
		echo $id;
		$sql = "SELECT * FROM user_favourites WHERE user_id = '$id'";
		$result = $db->query($sql);
		if ($result->num_rows == 0){
			echo "no";
			//return false;
		}
		else{
		
			$data_array = array();
			$counter = 0;
			while ($result_array = $result->fetch_assoc()){
				$favouriteid = $result_array['favourite_id'];
				$sqlUsers = "SELECT username FROM users WHERE id = '$favouriteid'";
				$resultUsers = $db->query($sqlUsers);
				$result_arrayUsers = $resultUsers->fetch_assoc();
				$favouriteUsername = $result_arrayUsers['username'];
				$data_row = array(
				'favourite_id' => $favouriteid,
				'favourite_username' => $favouriteUsername);
				
				$data_array[$counter] = $data_row;
			$counter = $counter + 1;
			}
}		
		
echo json_encode($data_array);


?>
