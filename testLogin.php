<?php
	//connect to db
	$zero = 0;
	
	
	$conn = mysqli_connect('localhost','root','ecse428', 'mydb');
		
	
	$firstUser =$_POST['username'];
	$password = $_POST['password'];
		
		//if user does not exists, create new table entry
		
		$sql = "INSERT INTO testusers (ID, username, email, password) VALUES ( '$zero', '$firstUser' , '$zero', '$password')";
		mysqli_query($conn, $sql);	
		
		echo "pass";	
		
	mysqli_close($conn);
	
	
?>
