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
$result = mysqli_query($db, "SELECT * FROM users") or die();
$number = $result->num_rows;
if ($number > 0) {
   		while ($row =  mysqli_fetch_array($result)){
   		$name[$h] = $row['username'];
   		$id[$h] = $row['id'];
   	 	$h++;
   	 	}
    	}

$username = utf8_urldecode($_GET["username"]);

//lookup all hints from array if length of username > 0
if (strlen($username) > 0)
  {
  $totalnum = 0;
  for($i=0; $i<count($name); $i++)
    {
    if (preg_match("/".$username."/i",$name[$i]))
      {
      $totalnum++;
      }
    }
  
  $hint="";
  for($i=0; $i<count($name); $i++){
    if (preg_match("/".$username."/i",$name[$i]))
		{
      
        $hint=$hint.'<div class="container1" id = '.$id[$i].'><div class="col-xs-8 col-xs-offset-2"></div><br><div class="row carousel-row">
					<div class="col-xs-offset-2 col-xs-3 slide-row2"><div id="carousel-1" class="carousel slide slide-carousel" data-ride="carousel">'.$name[$i].'<br></div>
					<div class="slide-content"><h4></h4><p><br></p></div><div class="slide-footer"></div></div></div></div>';
		}
    
    
    }
  
if ($hint == ""){
  echo "No results found.";
} else {
  echo $hint; 
}

}

?>