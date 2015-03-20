
<!DOCTYPE html>


<html>
	<head>
	
		<title>My Profile</title>


	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


	<!--Google Font-->
		<link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
		<link type="text/css" rel="stylesheet" href="css/general.css"/>
		<link type="text/css" rel="stylesheet" href="profileStyle.css"/>
		
		
		
		
 
	</head>

	<body>


		<div class = "navbar-outer">
        <nav class="navbar navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--<a class="navbar-brand">Roomr - Living Preferences</a>-->
        </div>

    <ul class="nav nav-tabs">
        
        <li><a href="livingPreferences.html">Interests</a></li>
		<li class = "active"><a href = "Profile.html"> My Profile </a></li>
        <li><a href="requests.html">Requests</a></li>
		<li><a href="aboutPage.html">About</a></li>
		<li><a href="search.html">Search</a></li>
		<li><a href="conversations.html">Conversations</a></li>
		
 <div id="navbar" class="navbar-collapse collapse">
         		  
		  <ul class="nav navbar-nav navbar-right">
									
									  <button type="button" class="btn btn-warning navbar-btn" onclick = "editProfile()"><span class="glyphicon glyphicon-edit"></span> Edit Profile</button>
									  <button type="button" class="btn btn-danger navbar-btn" onclick = "signOut()"><span class="glyphicon glyphicon-off"></span> Sign Out</button>
															
				</ul>
		 
        </div><!--/.nav-collapse -->
      
    </ul>
</div>
    </nav>
	</div>

		<div id="profile-page" style = "margin-left:7%">

			<div class="custom-container">
<!--Profile Picture-->

			<!--Profile Picture-->

			<?php 
			require ("dbConnect.php");
			$userid = 3;
			$users_image = mysqli_query($db, "SELECT * FROM users WHERE id='$userid' ORDER BY id ASC;") OR die(mysql_query());      
			$row_users_image = mysqli_fetch_assoc($users_image);
			$userimage = $row_users_image['imagelocation'];
			
			echo "<div class='profile-picture'>
					<img src='$userimage' width='175' height='175' />
					</div>";
			
			echo "<form method='post' action='profile.php' enctype='multipart/form-data' class='profile_picture_upload' onmouseover=this.className='profile_picture_upload_onmouseover' onmouseout=this.className='profile_picture_upload'>
				<span>Upload picture</span>
				<input type='file' name='myfile' class='upload' onchange='submit()'/>
				<input type='submit' id='upload_photo' value='Upload' style='display:none'>
				</form>";
	
	/* function to get the file extension */
		function getExtension($str){
			 $i = strrpos($str,".");
			 if (!$i) { return ""; }
			 $l = strlen($str) - $i;
			 $ext = substr($str,$i+1,$l);
			 return $ext;
		}
		
	/* upload photo */
		if(isset($_FILES['myfile'])){
			$name = preg_replace('/\s+/', '_', $_FILES['myfile']['name']);
			$extension = getExtension($name);
			$extension = strtolower($extension);
			$tmp_name= $_FILES['myfile']['tmp_name'];

			if($name){
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "bmp")){
					//print error message
					echo "<div class='profile_picture_upload_message'>(Please choose an image file)</div>";
				} else {	
					if(is_dir("photos/users/") == false){
						mkdir("photos/users/", 0777, true);
					}
					
					$timenow = time();
					$picture_name = "profile_picture_".$userid."_".$timenow."_".$name;
					$location = "photos/users/".$picture_name;
					move_uploaded_file($tmp_name,$location);
				   
					$sql_update =  mysqli_query($db, "UPDATE users SET imagelocation = '$location' WHERE id = $userid");
					echo "<div class='profile_picture_upload_message'>(Upload successfully. <a href='profile.php?userid=$userid'>Refresh</a>)</div>";
					header('Location: profile.php');
				}
			}
		} 
	?>
<!--About Me section-->

			<div class="about-me">
				<h2>About Me</h2>
				<table>

					<tbody>
					<tr>
						<th>Gender</th>
						<td>Male</td>
					</tr>
					<tr>
						<th>Age</th>
						<td>21</td>
					</tr>
					<tr>
						<th>Languages</th>
						<td>French and English</td>
					</tr>
					<tr>
						<th>Occupation</th>
						<td>Student</td>
					</tr>
					<tr>
						<th>Short Description</th>
						<td>Hello. I don't have much to say. But I think it would be good to have some holy santos brought to the high school to guard the hallway and to bring us good luck. El Santo Nino de Atocha is a good one. My Aunt Concha has seen him. And...we have a great F.F.A. schedule lined up-- and I'd like to see more of that. If you vote for me, all of your wildest dreams will come true. Thank you.</td>
					</tr>
					</tbody>
				</table>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>

<!--Living Preferences section-->



<!--Interests section-->

			<div class="interests">
				<h2>Interests</h2>

				<div>
					<ul id="interestList">
						
					</ul>
				</div>	
			</div>
			

<!--Favorites section-->

			<div class="favorites">
				<h2>Favorites</h2>
				<div>
					<ul id="favoritelist">
						<li>
							<img src="sampleFavoritePicture.jpeg" alt="" />
						</li>
						<li>
							<img src="sampleFavoritePicture.jpeg" alt="" />
						</li>
						<li>
							<img src="sampleFavoritePicture.jpeg" alt="" />
						</li>
						<li>
							<img src="sampleFavoritePicture.jpeg" alt="" />
						</li>
						<li>
							<img src="sampleFavoritePicture.jpeg" alt="" />
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<script type = "text/javascript">
			
			
			$.ajax({
		
				type: "POST",
				url: 'getProfile.php',
						
				success: function(data){
				
						var matches = JSON.parse(data);	
						for(i = 2 ; i<matches.length; i++){
							$("#interestList").append('<li>'+ matches[i] +'</li>');				
							
						}
						console.log(data);
				}
			
			
			});
		
		function signOut(){
		
		$.ajax({
		
			type: "POST",
                url: 'roomrLogout.php',
				
				success: function(data){
						if(data.trim() == "success"){
							window.location.replace("index.php");
							
						}
						else{
							window.alert("Logout failed, please try again");
						}
				
				}
		
		
		});
	
	
	}
	
	function editProfile(){

		window.location.replace("editProfilePage.html");
}
	
		</script>
	</body>
</html>


