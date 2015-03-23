<?php


session_start();

if (isset($_SESSION['most_recent_activity']) && 
    (time() -   $_SESSION['most_recent_activity'] > 60)) {
		
 //600 seconds = 10 minutes
	session_destroy();   
	session_unset();  
	echo "fail";
     
 }

 ?>