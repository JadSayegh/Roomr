<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';

		$user_id = '3';
		
       //get form data
       $houseApartment = $_GET['houseApartment'];
       $petFriendly = $_GET['petFriendly'];
       $party = $_GET['party'];
       $smokingFriendly = $_GET['smokingFriendly'];
	   $rentPriceRange = $_GET['rentPriceRange'];
	   $neighbourhood = $_GET['neighbourhood'];
	   $roommates = $_GET['roommates'];
       
	    $update =  mysqli_query($db, "UPDATE users SET houseApartment = '$houseApartment', petFriendly = '$petFriendly', party = '$party', smokingFriendly = '$smokingFriendly', rentPriceRange = '$rentPriceRange', neighbourhood = '$neighbourhood', roommates = '$roommates' WHERE id = $user_id") or die(mysqli_error());
                
        echo "ok";
             
    ?>