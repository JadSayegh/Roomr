<?php
include 'emailActivation.php';

require("dbConnect.php");
session_start();

$guysEmail = $_POST['userEmail'];

$requestPDB = "SELECT password FROM users WHERE username = '$guysEmail'";
$result = $db->query($requestPDB);

if ($result->num_rows == 0){
    echo "fail";
} else {
    
    $resultArray = $result->fetch_assoc();
    $actualPassword= $resultArray['password'];

    $subject = "Your recovered password is: ";

    email($guysEmail, $subject, $actualPassword);
}

?>