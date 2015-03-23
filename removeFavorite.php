<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';
		
		session_start();
		$username = $_SESSION['userid'];
		$favouritedUsername = ($_POST['favouritedID']);
		echo $favouritedUsername;
		echo $username;
		$sql = "DELETE from user_favourites WHERE favourite_id = '$favouritedUsername' AND user_id = '$username'";

		
		$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
		
		
    ?>
