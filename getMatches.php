<?php

require("dbConnect.php");


session_start();


$username = $_SESSION['username'];
$requestID = $_POST['requestID'];
$sql = "SELECT id FROM users where username = '$username'";
$userIDResult = $db->query($sql) or die('Unable to connect to database [' . $db->connect_error . ']');;
$userIDValue  = $userIDResult->fetch_row();
$userID = $userIDValue[0];
 echo "USER ID IS: ".$userID.PHP_EOL; 
$getRequest = "SELECT * FROM requests where id = '$$requestID'";
$requestResult = $db->query($getRequest) or die('Unable to connect to database [' . $db->connect_error . ']');   

$sql = "SELECT * FROM requests WHERE userid <> '$userID'";
$possibleMatch = $db->query($sql) or die('Unable to connect to database [' . $db->connect_error . ']');
$requestRow = $requestResult->fetch_assoc();

unset($sql);
unset($requestResult);
echo $possibleMatch->num_rows.PHP_EOL;

	while($row = $possibleMatch->fetch_assoc()){
		
			$matchPercentage = 100;  
			parseOptions($requestRow['roommates'],$row['roommates'], 5, $matchPercentage);
			parseOptions($requestRow['fees'], $row['fees'], 3, $matchPercentage);
			parseOptions($requestRow['neighborhoods'], $row['neighborhoods'], 2, $matchPercentage);
			parseOptions($requestRow['housed'], $row['housed'], 6,$matchPercentage);
			parseOptions($requestRow['smoke'], $row['smoke'], 6, $matchPercentage);
			parseOptions($requestRow['pet_friendly'], $row['pet_friendly'], 2, $matchPercentage);
			$userInterests = array();
			$matchInterests = array();
			$matchID = $row['userid'];
			$interestsSql= "SELECT user_id, interest_id FROM user_interests WHERE user_id = '$userID' OR user_id = '$matchID'";
			$interestResult = $db->query($interestsSql);
			
			while($interestRow = $interestResult->fetch_assoc()){
					if($interestRow['user_id'] = $userID){
						array_push($userInterests, $interestRow['interest_id']);
						
					}
					else{
						array_push($matchInterests, $interestRow['interest_id']);						
					}
			}
			
			$sizeDifference = count($userInterests) - count($matchInterests) ;
			echo $sizeDifference.PHP_EOL;
			if($sizeDifference>0){
				$matchPercentage = $matchPercentage - $sizeDifference;
				for($i = 0; $i < $sizeDifference; $i++) {
					array_push($matchInterests, 0);
				}
			}
			
			else if($sizeDifference<0){
				$matchPercentage = $matchPercentage + $sizeDifference;
				for($i = 0; $i< abs($sizeDifference); $i++){
					array_push($matchInterests, 0);
				}
				
			}							
			
			for($i = 0; $i<count($userInterests); $i++){
				for($j =0; $j<count($matchInterests); $j++){
					if($userInterests[$i] = $matchInterests[$j]){
						$matchPercentage = $matchPercentage +3;
					}
					
				}
				$matchPercentage = $matchPercentage -3;
			}	
			
			echo "match percentage is :".$matchPercentage.PHP_EOL;		
			unset($userInterests);
			unset($matchInterests);
			
			
	}



function parseOptions($requestValue, $comparedValue, $importance, $matchPercentage){
		
		//value for which each increasingly different degree of number of roommates affects the overall match value
	$roommateSimilarity = $requestValue - $comparedValue;
	$matchPercentage = $matchPercentage - abs($roommateSimilarity)*$importance;
	
}




?>