<?php

require("dbConnect.php");

session_start();
$senderID = $_SESSION['userid'];
if (isset($_POST["messageBody"]) && !empty($_POST["messageBody"])) {
    $messageBody = $_POST['messageBody'];
}
else{
		exit("empty");
}
$receiverID = $_POST['receiverID'];

$sql = "INSERT INTO messages (body, receiverID, senderID) VALUES ('$messageBody', '$receiverID', '$senderID')";


$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');

$sql = "INSERT INTO conversation (firstParticipant, secondParticipant) VALUES ('$senderID', '$receiverID') ";

if($db->query($sql)){
	echo "conversation created";
}else{
	echo "conversation exists";
}

echo "success";

?>