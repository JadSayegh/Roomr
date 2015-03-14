<?php

require("dbConnect.php");

session_start();
$senderID = $_SESSION['userid'];

$sql = "SELECT firstParticipant FROM conversation WHERE secondParticipant = '$senderID' UNION SELECT SecondParticipant FROM conversation WHERE firstParticipant = '$senderID'";
$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');

echo json_encode($result->fetch_all());




?>