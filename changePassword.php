<?php
    // Get user who is currently logged on
    require("dbConnect.php");
    session_start();
    $username = $_SESSION['username'];
    //$result = $db->query($requestUDB);
    
    $oldPassword = $_POST['password'];
    $newPassword = $_POST['newPassword'];

    
    $requestPDB = "SELECT password FROM users WHERE username = '$username'";
    $result = $db->query($requestPDB);
    $resultArray = $result->fetch_assoc();
    $actualPassword= $resultArray['password'];

    if($oldPassword === $actualPassword) {
        $requestPasswordChange = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
        $changed = $db->query($requestPasswordChange);
        echo "success"; //$changed;
    } else {
        echo "fail";
    }

    $db->close();                                    
?>