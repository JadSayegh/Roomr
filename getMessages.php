<?php

require("dbConnect.php");

session_start();
$senderID = $_SESSION['userid'];
$receiverID = $_POST['receiverID'];

$sql = "SELECT * FROM Messages WHERE senderID = '$senderID' AND receiverID = '$receiverID'";

$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');;

echo json_encode($result->fetch_all());

?>