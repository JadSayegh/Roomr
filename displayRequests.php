<?php

require("dbConnect.php");
    
    
	session_start();
		$username = $_SESSION['username'];
		$sql = "SELECT id from users  WHERE username = '$username'";
		$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
		
		$activateValue = $result->fetch_row();
		$user_id = $activateValue[0];
		//echo $user_id;
	  $sql = "SELECT * FROM requests WHERE userid = '$user_id'";
	 $result = $db->query($sql);
	if ($result->num_rows == 0){
			echo "no";
			//return false;
			
		}
		else{	
$data_array = array();
$counter = 0;

while ($result_array = $result->fetch_assoc()){
	$neighbourhood = $result_array['neighborhoods'];
	$roommates = $result_array['roommates'];
	$fees = $result_array['fees'];
	$party = $result_array['interests'];
	$housed = $result_array['housed'];
	$smoke = $result_array['smoke'];
	$pet_friendly = $result_array['pet_friendly'];
	$rid = $result_array['id'];
	$data_row = array(
	'rid' => $rid,
          'neighbourhood' => $neighbourhood,
          'roommates' => $roommates,
	'fees' => $fees,
	'party' => $party,
	'housed' => $housed,
	'smoke' => $smoke,
	'pet_friendly' => $pet_friendly);
	
	$data_array[$counter] = $data_row;
$counter = $counter + 1;
	
}
}		
		
echo json_encode($data_array);


?>
