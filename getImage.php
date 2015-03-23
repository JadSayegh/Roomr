<?php
require ("dbConnect.php");
			session_start();
			$username = $_POST['username'];
			$users_image = mysqli_query($db, "SELECT * FROM users WHERE username='$username'") OR die(mysql_query());      
			$row_users_image = mysqli_fetch_assoc($users_image);
			$userimage = $row_users_image['imagelocation'];
			
			echo "<div class='profile-picture'>
					<img src='$userimage' width='250' height='250' />
					</div>";
						
?>