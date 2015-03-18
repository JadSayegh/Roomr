<?php

require ("dbConnect.php");

session_start();

$senderID = $_SESSION['userid'];

$receiverID = $_POST['receiverID'];



$sql = "SELECT * FROM conversation WHERE firstParticipant = '$senderID' AND secondParticipant = '$receiverID' 
		UNION SELECT * FROM conversation WHERE firstParticipant = '$receiverID' AND secondParticipant = '$senderID'";

$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']'); 		
if($result->num_rows == 0){
	
	$sql = "INSERT INTO conversation (firstParticipant, secondParticipant) VALUES ('$senderID', '$receiverID') ";

	if($db->query($sql)){
		echo "conversation created";
	}else{
		echo "conversation exists";
	}

}
echo "success";


?>