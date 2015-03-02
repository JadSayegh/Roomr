<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';
		
       //get form data
       $houseApartment = $_GET['houseApartment'];
       $petFriendly = $_GET['petFriendly'];
       $party = $_GET['party'];
       $smokingFriendly = $_GET['smokingFriendly'];
	   $rentPriceRange = $_GET['rentPriceRange'];
	   $neighbourhood = $_GET['neighbourhood'];
	   $roommates = $_GET['roommates'];
 
		$query = mysqli_query($db, "SELECT * FROM users WHERE houseApartment = $houseApartment AND petFriendly = $petFriendly AND party = $party AND smokingFriendly = $smokingFriendly AND rentPriceRange = $rentPriceRange AND rentPriceRange = $rentPriceRange AND roommates = $roommates");

		if ($query){
			if (($query->num_rows) == 0){
				echo "No results found.";
			} else {
				while ($query_row = mysqli_fetch_assoc($query)){
					$name = $query_row['username'];
					$id = $query_row['id'];
					echo '<div class="container1" id = '.$id.'><div class="col-xs-8 col-xs-offset-2"></div><br><div class="row carousel-row">
					<div class="col-xs-offset-2 col-xs-3 slide-row2"><div id="carousel-1" class="carousel slide slide-carousel" data-ride="carousel">'.$name.'<br></div>
					<div class="slide-content"><h4></h4><p><br></p></div><div class="slide-footer"><button onclick = '.'\''.'displayProfile('.'"'.$name.'"'.')'.'\''.'> View Profile </button></div></div></div></div>';
				}
			}
		} else {
			echo mysqli_error();
		}
		
    ?>
