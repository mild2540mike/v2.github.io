<?php
	session_start();

	include('admin/include/conn.php');
	
	$sql="SELECT * FROM login_admin where username='".$_POST['username']."'AND password='".$_POST['password']."'";
	$result=mysqli_query($conn,$sql);
	$numrow=mysqli_num_rows($result);
	
	$row=mysqli_fetch_assoc($result);
	
	if($numrow==0){
		echo "<script type='text/javascript'>";
		echo "alert('คุณไม่ได้เป็นสมาชิก');";
		echo "window.location.href = 'login.php';";
		echo "</script>";
	}else{

		if($row["status"]==1){
			header("Location:admin/index.php");
		}else{
			header("Location:admin/index.php");
		}
		$_SESSION["name"]=$_POST["username"];
		
	}
	

?>