<?php  
// Connects to Our Database  
$db = new mysqli('localhost', 'root', '', 'roomr');

if($db->connect_errno > 0){
    $db = new mysqli('localhost', 'root', 'root', 'roomr');
}

if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
 ?>