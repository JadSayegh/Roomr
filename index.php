
<!DOCTYPE html>
<html lang="en" class="full">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roomr</title>

	
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="jquery.cookie.js"></script>
	
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!--Google fonts-->
	<link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
  </head>
  <body>
  	<script>
	
	
		  // This is called with the results from from FB.getLoginStatus().
		  function statusChangeCallback(response) {
			console.log('statusChangeCallback');
			console.log(response);
			// The response object is returned with a status field that lets the
			// app know the current login status of the person.
			// Full docs on the response object can be found in the documentation
			// for FB.getLoginStatus().
			if (response.status === 'connected') {
			  // Logged into your app and Facebook.
			  testAPI();
			} else if (response.status === 'not_authorized') {
			  // The person is logged into Facebook, but not your app.
			  document.getElementById('status').innerHTML = 'Please log ' +
				'into this app.';
			} else {
			  // The person is not logged into Facebook, so we're not sure if
			  // they are logged into this app or not.
			  document.getElementById('status').innerHTML = 'Please log ' +
				'into Facebook.';
			}
		  }
			
		function fbEnsureInit(callback) {
			if(!window.fbApiInit) {
				setTimeout(function() {fbEnsureInit(callback);}, 50);
			} else {
				if(callback) {
					callback();
				}
			}
		}
	
		  // This function is called when someone finishes with the Login
		  // Button.  See the onlogin handler attached to it in the sample
		  // code below.
		  function checkLoginState() {
			
			FB.getLoginStatus(function(response) {
			  statusChangeCallback(response);
			  
			});
			FB.logout(function(response) {
			// user is now logged out
			});
		  
			
		  }

		  window.fbAsyncInit = function() {
		  
		  FB.init({
			status	   : false,
			appId      : '1676428672584251',
			cookie     : true,  // enable cookies to allow the server to access 
								// the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.1', // use version 2.1
			cookie     : true // enable cookies to allow the server to access the session

			
		  });
		  	 fbEnsureInit(function() {
				console.log("this will be run once FB is initialized");
			});
						
			
		  // Now that we've initialized the JavaScript SDK, we call 
		  // FB.getLoginStatus().  This function gets the state of the
		  // person visiting this page and can return one of three states to
		  // the callback you provide.  They can be:
		  //
		  // 1. Logged into your app ('connected')
		  // 2. Logged into Facebook, but not your app ('not_authorized')
		  // 3. Not logged into Facebook and can't tell if they are logged into
		  //    your app or not.
		  //
		  // These three cases are handled in the callback function.
		
		 
		  };

		  // Load the SDK asynchronously
		  (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));

		  // Here we run a very simple test of the Graph API after login is
		  // successful.  See statusChangeCallback() for when this call is made.
		  function testAPI() {
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
			  console.log('Successful login for: ' + response.name);
			  document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.name + '!';
				FBLogin(response.email);
			});
		  }
		  
		  
		function FBLogin(email_address){
		
			$.ajax({
			
			type : "POST",
			url : "roomrFBLogin.php",
			data: {email : email_address},
			success: function(data){
					if(data.indexOf("success") != -1){
						localStorage.currentUser = email_address;
						setID(data);
						window.location.replace("roomrHome.html");
					}
					else{
						window.alert("THERE WAS A PROBLEM LOGGING IN");
					}			
			}			
			});
		
		}
	</script>
	
  <script src="http://connect.facebook.net/en_US/all.js"></script>
  
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Roomr</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	
	<!--REGISTRATION FORM -->
	<div class = "customContainer">
	<div id="fb-root"></div>
	<div class = "register">
	<form name = "registration" class="form-horizontal" >
	  
		<div id="legend">
		  <legend class="">Register</legend>
		</div>
		<div class="control-group">
		  <!-- Username -->
		  <label class="control-label"  >Username</label>
		  <div class="controls" id = "warnUsername">
			<input type="text" id="registerUsername" name="registerUsername" placeholder="" class="input-xlarge" oninput="searchUsernameExists()" onpropertychange="searchUsernameExists()">
			<p id = "usernameExists"></p>
			<p class="help-block">Username can contain only letters or numbers, and must be at least 8 characters</p>
		  </div>
		</div>
	 
		<div class="control-group">
		  <!-- E-mail -->
		  <label class="control-label" >E-mail</label>
		  <div class="controls" id = "warnEmail">
			<input type="text" id="registerEmail" name="registerEmail" placeholder="" class="input-xlarge">
			<p class="help-block">Please provide your E-mail</p>
		  </div>
		</div>
	 
		<div class="control-group">
		  <!-- Password-->
		  <label class="control-label" >Password</label>
		  <div class="controls" id = "warnPassword">
			<input type="password" id="registerPassword" name="registerPassword" placeholder="" class="input-xlarge">
			<p class="help-block">Password should be at least 8 characters and must contain one number</p>
		  </div>
		</div>
	 
		<div class="control-group">
		  <!-- Password -->
		  <label class="control-label"  >Password (Confirm)</label>
		  <div class="controls" id = "warnConfirmPassword">
			<input type="password" id="registerConfirmPassword" name="registerConfirmPassword" placeholder="" class="input-xlarge">
			<p class="help-block">Please confirm password</p>
		  </div>
		</div>
	 </form>
		<div class="control-group">
		  <!-- Button -->
		  <div class="controls">
			<button class="btn btn-success" onclick = "signUp()">Register</button>
		  </div>
		</div>
	</div>
	  

   <!--LOGIN FORM -->
  <div class = "login">
	<form name = "login" class="form-horizontal" >
	 
		<div id="legend">
		  <legend class="">Login</legend>
		</div>
		<div class="control-group">
		  <!-- Username -->
		  <label class="control-label"> Username</label>
		  <div class="controls">
			<input type="text" id="loginUsername" name="loginUsername" value="<?php
				if(isset($_COOKIE['remember_me_username'])){
					echo $_COOKIE['remember_me_username']; 
				}
				?>" class="input-xlarge">
		  </div>
		</div>
	  
		<div class="control-group">
		  <!-- Password-->
		  <label class="control-label" >Password</label>
		  <div class="controls">
			<input type="password" id="loginPassword" name="loginPassword" value="<?php
					if(isset($_COOKIE['remember_me_password'])){
						echo $_COOKIE['remember_me_password'];
					}					
						?>" class="input-xlarge">
		   
		  </div>
		</div>

	 
        <div class="control-group">
		  <!-- Remember Me checkbox-->
		  <div class="controls">
			<input type="checkbox" id="loginRemember" name="loginRemember" value="1" <?php
				if(isset($_COOKIE['remember_me'])) echo 'checked'; ?>>Remember Me
            </div>
		   
		  </div>

	  
	 </form>
		<div class="control-group">
		  <!-- Login Button -->
		  <div class="controls">
		  <br>
			<button class="btn btn-success" onclick = "roomrLogin()">Login</button>
			<div id = "loginWarning"></div>
		  </div>
		</div>
      
        <br>
        <br>
      
    <p>Forgotten Password? <br> Enter Email:</p>
      <form id="rpForm" action = >
        <input type = "text" id="rpusername">
    </form>
      
    <button type="button" class="btn btn-warning navbar-btn" onclick = "recoverPassword()"><span class="glyphicon glyphicon-edit"></span>Submit</button>
		
  </div>
   
  
  <!--
		  Below we include the Login Button social plugin. This button uses
		  the JavaScript SDK to present a graphical Login button that triggers
		  the FB.login() function when clicked.
		-->

		<div id = "build1" class = "login">			
				
				<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
				</fb:login-button>

				<div id="status">
				</div>			
			
		</div>
		
	
		
	
   </div> 
   
    <!-- MATTHEW BEIROUTI EDITS -->

      

    <!-- END MATTHEW BEIROUTI EDITS -->    
      
	


    <script type="text/javascript">
	
		
		loginCounter = 0;
		loginFlag = true;
		
	    <!-- MATTHEW CHANGES -->
            
        function recoverPassword(){
            
                var formInput = document.getElementById("rpForm");
                
                var username = formInput.elements[0].value;
                
                console.log(username);
            
            $.ajax({
                type: "POST",
                url: 'recoverPassword.php',
                data: { 
                    userEmail :  username
                },
                success: function(data){
                 console.log(data);
                if(data.trim() == "fail"){
                     alert("The username entered is not associated with any account. Please Try again!");
                 } else {
                     alert("The corresponding password has been sent to the email entered!");
                 }
                }
            }); 
                   
        }

        
        <!-- END MATTHEW CHANGES -->
		function formValidation(){
		
			var username = $('#registerUsername').val();
			var password = $('#registerPassword').val();
			var confirmPassword = $('#registerConfirmPassword').val();
			var email = $('#registerEmail').val();
			
			console.log(username, password, confirmPassword, email);
			var emailCheck = emailValidation(email);
			var passwordCheck = passwordValidation(password, confirmPassword);
			var usernameCheck = usernameValidation(username);
			
			if( emailCheck && passwordCheck && usernameCheck ){
				return true;
			}
			else return false;
			
		}
		
		function emailValidation(email){
			var emailLength = email.length
			if (emailLength < 3 || emailLength > 50){
			console.log("email");
			$("#warnEmail").append("<div class = 'warning'> please enter valid email </div>");
				//please enter valid email
				return false;
			}
			else if(email.indexOf("@") == -1){
				$("#warnEmail").append("<div class = 'warning'> please enter valid email </div>");
			 //please enter valid email
			 return false;
			}
			else return true;
		}
		
		function usernameValidation(username){
			var usernameLength = username.length;
			if(usernameLength < 8){
				// your username is too short
				$("#warnUsername").append("<div class = 'warning'> your username is too short! </div>");
				return false;
			}
			else if (usernameLength > 16){
				// your username is too long
				$("#warnUsername").append("<div class = 'warning'> your username is too short! </div>");
				return false;
			}
			else return true;
			
		}
		function passwordValidation(password, confirmPassword){
			var passLength = password.length;
			
			if(passLength<8){
				// your password is too short
				$("#warnPassword").append("<div class = 'warning'> your password is too short! </div>");
				return false;
			}
			else if (passLength >16){
				//your password is too long
				$("#warnPassword").append("<div class = 'warning'> your password is too long! </div>");
				return false;
			}
			else if(!isNaN(parseFloat(password)) && isFinite(password)){
				//your password must contain at least one number
				$("#warnPassword").append("<div class = 'warning'> your password must contain at least on number! </div>");
				return false;
			}
			else if (password != confirmPassword){
				//your passwords do not match
				$("#warnPassword").append("<div class = 'warning'> your confirmation password does not match! </div>");
				return false;
			}
			else return true;
		}
		
		function searchUsernameExists(){
			$("#usernameExists").empty();
		var username = $('#registerUsername').val();
		console.log(username);
		$.ajax({
						
							type: "POST",
							url: 'searchUsernameExists.php',
					dataType : 'text',
					data: { 
						username : username,
						},
					success: function(datum){	
							console.log(datum);
							if(datum.trim() == "not unique"){	
							$("#usernameExists").append("<b>Username Already Exists</b>");				
							}
					}
					});
		}
	
		function roomrLogin(){
			loginCounter++;
			var remember = 0;
			if($.cookie("blocked") == null){
				
				if(loginCounter<5 ){
					var username = $('#loginUsername').val();
					var password = $('#loginPassword').val();
					var checkbox = document.getElementById("loginRemember");
					
                    if(checkbox.checked){
                        remember = checkbox.value;
                    }else{
                        remember = 0;   
                    }    
					loginFlag = true;
					console.log(username, password, remember);
					
					$.ajax({
						
							type: "POST",
							url: 'roomrLogin.php',
					dataType : 'text',
					data: { 
						username : username,
						password : password,
                        remember : remember
						},
					success: function(datum){	
							localStorage.currentUser = username;
							setID(datum);
							console.log(datum);					
							if(datum.indexOf("pass") != -1) {
								console.log("woo");
								window.location.replace("roomrHome.html");
								//$("#loginWarning").remove();
							}
							else {
								loginFlag = false;
							//	$('#loginForm').trigger("reset");
								$("#loginWarning").append("<div class = 'warning'> User does not exist or password is invalid </div>");
								console.log("FAILURE");
								}
							}
					});
				} else{
					
					var date = new Date();
					date.setTime(date.getTime() + (60 * 1000));
					$.cookie("blocked", 1, {expires :date});
					$("#loginWarning").append("<div class = 'warning'> You entered wrong user info too many times! please wait 60 seconds </div>");
					loginCounter = 0;
					
				}
			} else{
					$("#loginWarning").append("<div class = 'warning'> Please wait </div>");
			}
		}
		
		function setID(answerData){
			
				var userID = parseInt(answerData.substr(answerData.indexOf('userid')+6));
				localStorage.currentID = userID;
				
		}
		function signUp(){			
		
			if( formValidation()){
			
				console.log("signing up");
				var username = $('#registerUsername').val();
				var email = $('#registerEmail').val();
				var password = $('#registerPassword').val();
				var passwordConfirm = $('#registerConfirmPassword').val();
			
				console.log(username, password);
			
				$.ajax({
					
					type: "POST",
					url: 'roomrRegister.php',
					data: { 
							username :  username,
							email : email,
							password : password				
						},
					success: function(data)
								{	
														
									if(data.indexOf("success") != -1){
										console.log("woo");
										localStorage.currentUser = username;
										setID(data);
										$( document ).ready(function(){
											
											window.location.replace("roomrHome.html");
										});
									}
									else {
										var errorMessage = "";
										
										if(data.indexOf("ALREADY EXISTS") != -1){
											errorMessage += "Username or email are already in use. ";
										}
										else if(data.indexOf("password") != -1){
											errorMessage += "Invalid password. please choose another one. ";
										}
										else {
											errorMessage += "Invalid username or email. please try again";
										}
										
										window.alert(errorMessage);
										console.log("FAILED SIGN UP");
									}
								}
				
				}); 
			}
			else{
				console.log("registration error");
			}
		}
	
    </script>
  </body>
</html>

