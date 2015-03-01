<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';
		
		session_start();
		$username = $_SESSION['username'];
		$sql = "SELECT id from users  WHERE username = '$username'";
		$result = $db->query($sql) or die('There was an error running the query [' . $db->error . ']');
		
		$activateValue = $result->fetch_row();
		$user_id = $activateValue[0];
		
		
		
		
       //get form data
       $houseApartment = $_GET['houseApartment'];
       $petFriendly = $_GET['petFriendly'];
       $party = $_GET['party'];
       $smokingFriendly = $_GET['smokingFriendly'];
	   $rentPriceRange = $_GET['rentPriceRange'];
	   $neighbourhood = $_GET['neighbourhood'];
	   $roommates = $_GET['roommates'];
       
	    $update =  mysqli_query($db, "UPDATE users SET houseApartment = '$houseApartment', petFriendly = '$petFriendly', party = '$party', smokingFriendly = '$smokingFriendly', rentPriceRange = '$rentPriceRange', neighbourhood = '$neighbourhood', roommates = '$roommates' WHERE id = '$user_id'") or die(mysqli_error());
        
		$request = mysqli_query($db, "INSERT INTO requests (userid, neighborhoods, roommates, fees, interests, housed, smoke, pet_friendly) VALUES ('$user_id', '$neighbourhood', '$roommates', '$rentPriceRange', '$party','$houseApartment', '$smokingFriendly','$petFriendly')" ) or die('There was an error running the query [' . $db->error . ']');  

		$sql = "SELECT id FROM requests WHERE userid = '$user_id'";
		$result = mysqli_query($db, $sql);
		$resultArray = $result->fetch_assoc();
		echo $resultArray['id'];
		
    ?>
