<?php
	include('include/conn.php');
	$id_fix = $_POST['id_fix'];
	$dname = $_POST['dname'];
	$date_fix = $_POST['date_fix'];
	$break_d = $_POST['break_d'];
	$status = $_POST['status'];
	$price_fix = $_POST['price_fix'];
	
	$sql="UPDATE tb_fix SET dname='".$dname."' ,date_fix='".$date_fix."' ,break_d='".$break_d."' ,status='".$status."' ,price_fix='".$price_fix."'  WHERE id_fix = '".$id_fix."'";
	
	
	$result=mysqli_query($conn,$sql);
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('อัพเดทข้อมูลการซ่อมสำเร็จ');";
		echo "window.location.href = 'fix.php';";
		echo "</script>";
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('ไม่สามารถอัพเดทได้');";
		echo "window.location.href = 'fix.php';";
		echo "</script>";
	}
?>