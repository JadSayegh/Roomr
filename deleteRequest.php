<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';

        $requestID = $_POST['requestID'];
       
	    $delete =  mysqli_query($db, "DELETE FROM requests WHERE id = '$requestID'") or die(mysqli_error());  
    ?>
