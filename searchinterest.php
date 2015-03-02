<?php
header('Content-type: text/html; charset=utf-8');
include 'dbConnect.php';

function utf8_urldecode($str) {
			$str = nl2br($str);
			$str = str_replace("'","\'",$str);
			$str = str_replace("<","&lt;",$str);
    		$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    		return html_entity_decode($str,null,'gb2312');
    		}

$h=0;
$result = mysqli_query($db, "SELECT * FROM interests") or die();
$number = ($result->num_rows);
if ($number > 0) {
   		while ($row =  mysqli_fetch_array($result)){
   		$name[$h] = $row['name'];
   		$id[$h] = $row['id'];
   	 	$h++;
   	 	}
    	}

$interestname = utf8_urldecode($_GET["name"]);

//lookup all hints from array if length of interestname > 0
if (strlen($interestname) > 0)
  {
  $hint="";
  for($i=0; $i<count($name); $i++){
    if (preg_match("/".$interestname."/i",$name[$i])){
		$result2 = mysqli_query($db, "SELECT * FROM user_interests WHERE interest_id = '$id[$i]'") or die();
		$number2 = ($result2->num_rows);
		if ($number2 > 0) {
			$j = 0;
			while ($row2 =  mysqli_fetch_array($result2)){
				$user_id[$j] = $row2['user_id'];
				
				$result3 = mysqli_query($db, "SELECT * FROM users WHERE id = '$user_id[$j]'") or die();
				$row3 =  mysqli_fetch_array($result3);
				$user_name[$j] = $row3['username'];
				
				$hint=$hint.'<div class="container1" id = '.$user_id[$j].'><div class="col-xs-8 col-xs-offset-2"></div><br><div class="row carousel-row">
						<div class="col-xs-offset-2 col-xs-3 slide-row2"><div id="carousel-1" class="carousel slide slide-carousel" data-ride="carousel">'.$user_name[$j].'<br></div>
						<div class="slide-content"><h4></h4><p><br></p></div><div class="slide-footer"><button onclick = '.'\''.'displayProfile('.'"'.$user_name[$j].'"'.')'.'\''.'> View Profile </button></div></div></div></div>';
						
				$j++;
			}
		}
    }
  }
  
	if ($hint == ""){
	  echo "No results found.";
	} else {
	  echo $hint; 
	}

  }
?>