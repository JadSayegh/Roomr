<?php

require("dbConnect.php");


session_start();

$json = array(array( 'id' =>'',
					 'username' =>'',
					 'email' =>'',
					 'matchPercentage' =>''	,
					 'requestID' => ''
					));
$username = $_SESSION['username'];

$requestID = $_POST['requestID'];
$sql = "SELECT id FROM users where username = '$username'";
$userIDResult = $db->query($sql) or die('Unable to connect to database [' . $db->connect_error . ']');;
$userIDValue  = $userIDResult->fetch_row();
$userID = $userIDValue[0];
 
$getRequest = "SELECT * FROM requests where id = '$requestID'";
$requestResult = $db->query($getRequest) or die('Unable to connect to database [' . $db->connect_error . ']');   
$requestRow = $requestResult->fetch_assoc();

$sql = "SELECT * FROM requests WHERE userid <> '$userID'";
$possibleMatch = $db->query($sql) or die('Unable to connect to database [' . $db->connect_error . ']');


function parseOptions($requestValue, $comparedValue, $importance, $matchPercentage){
		
		//value for which each increasingly different degree of number of roommates affects the overall match value
	$roommateSimilarity = $requestValue - $comparedValue;
	return abs($roommateSimilarity)*$importance;
	
}

$rowNumber = 0;
	while($row = $possibleMatch->fetch_assoc()){
		
			$matchPercentage = 100;  
			$matchPercentage -= parseOptions($requestRow['roommates'],$row['roommates'], 5, $matchPercentage);
			$matchPercentage -= parseOptions($requestRow['fees'], $row['fees'], 3, $matchPercentage);
			$matchPercentage -= parseOptions($requestRow['neighborhoods'], $row['neighborhoods'], 2, $matchPercentage);
			$matchPercentage -= parseOptions($requestRow['housed'], $row['housed'], 6,$matchPercentage);
			$matchPercentage -= parseOptions($requestRow['smoke'], $row['smoke'], 6, $matchPercentage);
			$matchPercentage -= parseOptions($requestRow['pet_friendly'], $row['pet_friendly'], 3, $matchPercentage);
			
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
			
			
			if($matchPercentage> 0){
				
			
			$replySql = "SELECT id, username, email FROM users WHERE id = '$matchID'";
			$replyResult = $db->query($replySql) or die('Unable to connect to database [' . $db->connect_error . ']');
			$replyValues = $replyResult->fetch_assoc();
			$json[$rowNumber]['id'] = $replyValues['id'];
			$json[$rowNumber]['username'] = $replyValues['username'];
			$json[$rowNumber]['email'] = $replyValues['email'];
			$json[$rowNumber]['matchPercentage'] = $matchPercentage;
			$json[$rowNumber]['requestID'] = $matchID;
			$rowNumber++;
			}
				
			//unset($userInterests);
			//unset($matchInterests);
			
		rsort($json);		
	}

echo json_encode($json);
unset($userInterests);
unset($matchInterests);
unset($possibleMatch);
unset($requestRow);







?>