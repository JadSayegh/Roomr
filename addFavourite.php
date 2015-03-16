<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';
		
		session_start();
		$username = $_SESSION['userid'];
		$favouritedUsername = ($_POST['favouritedID']);
		echo $favouritedUsername;
		echo $username;
		$sql = "SELECT * from user_favourites WHERE favourite_id = '$favouritedUsername' AND user_id = '$username'";

		
		$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
		
		if ($result->num_rows == 0){
			$favourite = mysqli_query($db, "INSERT INTO user_favourites (user_id, favourite_id ) VALUES ('$username','$favouritedUsername')") or die('Error inserting favourite - There was an error running the query [' . $db->error . ']');
		} else {
		echo 'Already Favourited';
		}

		
    ?>
