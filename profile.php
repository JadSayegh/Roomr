
<?php
    session_start();
    
    echo "<p>PROFILE VIEW</p>";
    require "dbConnect.php";

    #TODO: check whether the session variable has something in it from login. 
    $username = $_GET["username"];
    if(!$username) $username = $_SESSION["username"];
    #$email = $_SESSION["email"];

    echo '<p>Username: '.$username.'</p>';
    
    $sql = "SELECT id, email FROM users WHERE username = '$username'";
        
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
    
    
    $user_id = $email = $result_array["id"];
    

    $sql = "SELECT name FROM interests INNER JOIN user_interests ON interests.id = user_interests.interest_id WHERE user_interests.user_id = '$user_id'";


    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
	}else if($result->num_rows == 0){
		var_dump($result);
        echo "No interests have been specified for this profile yet.. \n";
    }

echo "Interests: ";
for($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--){
    $result_array = $result->fetch_assoc();
    echo $result_array["name"];
    if($row_no > 0) echo ', '; 
}
?>
