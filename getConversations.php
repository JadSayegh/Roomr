<?php

require("dbConnect.php");

session_start();
$senderID = $_SESSION['userid'];

$sql = "SELECT firstParticipant FROM conversation WHERE secondParticipant = '$senderID' UNION SELECT SecondParticipant FROM conversation WHERE firstParticipant = '$senderID' ";
$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');

$recipiants = array();
$i = 0;
while($row = $result->fetch_row()){
		$recipiantID = $row[0];
		$sql = "SELECT id, username, email FROM users WHERE id = '$recipiantID'";
		$recipiantResult = $db->query($sql);
		$recipiants[$i] = $recipiantResult->fetch_assoc();
		$i++;
}


echo json_encode($recipiants);




?>