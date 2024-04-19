<?php
//connect to mysql

$password = trim(file_get_contents("/home/ubuntu/password.txt"));

$mysqli = new mysqli('localhost', 'root', $password, 'lamp_db');

$dataConn = true;

if (mysqli_connect_errno()) {
	//printf("Connect failed: %s\n", mysqli_connect_error());
	$dataConn = false;
	//exit();
}

?>