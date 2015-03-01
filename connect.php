<?php
$conn_error = 'Could not connect.';

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'roomr';

if (mysql_connect($mysql_host, $mysql_user, $mysql_pass)){
	if (mysql_select_db($mysql_db)){
		//echo 'Connected!';
	} else {
		die($conn_error);
	}
} else {
		die($conn_error);
}

?>
