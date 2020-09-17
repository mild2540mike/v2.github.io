<?php
	$server="localhost"; //127.0.0.1
	$username="root";
	$password="root123456";
	$dbname="login_db";
	$conn=mysqli_connect($server,$username,$password,$dbname);
	
	if(!$conn){
		echo "Connect Fail ! <br>";
	}
	//เปลี่ยนภาษา
	mysqli_query($conn,"SET NAMES UTF8");
	
?>