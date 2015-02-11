
<?php
    session_start();
    
    echo "<p>PROFILE VIEW</p>";
    require "dbConnect.php";

    #TODO: check whether the session variable has something in it from login. 
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];

    echo '<p>Username: '.$username.'</p>';
    
    $sql = "SELECT email FROM users WHERE username = '$username'";
        
    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
	}else if($result->num_rows == 0){
		var_dump($result);
        echo "\ERROR: This profile does not exist. \n";
    }

    
    $result_array = mysqli_fetch_assoc($result);
    
//    $name = $result_array['name'];
    $email = $result_array["email"];
 //   echo "Name: $name";
    echo  '<p>Email: '.$email .'</p>';
    
    

?>
