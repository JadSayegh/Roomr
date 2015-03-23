<?php  
if(isset($_SESSION['most_recent_activity'])){
	$_SESSION['most_recent_activity'] = time(); // the start of the session.
}
// Connects to Our Database  
$db = new mysqli('localhost', 'root', '', 'roomr');

if($db->connect_errno > 0){
    $db = new mysqli('localhost', 'root', 'root', 'roomr');
}

if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
 ?>