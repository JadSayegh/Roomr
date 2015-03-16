<?php

require("dbConnect.php");

session_start();
$senderID = $_SESSION['userid'];
$receiverID = $_POST['receiverID'];

$sql = "(SELECT mid, body, senderID, receiverID, timeStamp FROM Messages WHERE senderID = '$senderID' AND receiverID = '$receiverID')
		UNION 
		(SELECT mid, body, senderID, receiverID, timeStamp FROM Messages WHERE senderID = '$receiverID' AND receiverID = '$senderID') ORDER BY mid ASC";

$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');;

echo json_encode($result->fetch_all());

?>