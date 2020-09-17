<?php
	include('include/conn.php');
	
	$id_type = $_POST['id_type'];
	$id_fix = $_POST['id_fix'];
	$id_item = $_POST['id_item'];
	$id_doc = $_POST['id_doc'];
	$id_bill = $_POST['id_bill'];

	$date_item = $_POST['date_item'];
	$name_type = $_POST['name_type'];
	$brand = $_POST['brand'];
	$id_department = $_POST['id_department'];
	$num_d = $_POST['num_d'];
	$Proof_pay = $_POST['Proof_pay'];
	$c_list = $_POST['c_list'];
	$note = $_POST['note'];
	$price = $_POST['price'];
	$how_to = $_POST['how_to'];
	$use_to = $_POST['use_to'];
	$fix_status = $_POST['fix_status'];


	
	$sql1="UPDATE tb_fix SET fix_status='".$fix_status."' WHERE id_fix = '".$id_fix."'";
	$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error());

	$sql2="UPDATE tb_type SET name_type='".$name_type."' ,brand='".$brand."' WHERE id_type = '".$id_type."'";
	$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error());

	$sql3="UPDATE tb_doc SET note='".$note."' ,date_item='".$date_item."',id_department='".$id_department."' WHERE id_doc = '".$id_doc."'";
	$result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error());

	$sql4="UPDATE tb_da SET price='".$price."' ,how_to='".$how_to."' ,use_to='".$use_to."' WHERE id_item = '".$id_item."'";
	$result4 = mysqli_query($conn, $sql4) or die ("Error in query: $sql4 " . mysqli_error());

	$sql5="UPDATE tb_bill SET c_list='".$c_list."' ,Proof_pay='".$Proof_pay."' ,num_d='".$num_d."' WHERE id_bill = '".$id_bill."'";
	$result5 = mysqli_query($conn, $sql5) or die ("Error in query: $sql5 " . mysqli_error());


	mysqli_close($conn);

	$result=mysqli_query($conn,$sql);
	if($result1||$result2||$result3||$result4||$result5){
		echo "<script type='text/javascript'>";
		echo "alert('เปลี่ยนแปลงข้อมูลการซ่อมสำเร็จ');";
		echo "window.location.href = 'manage.php';";
		echo "</script>";
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('ไม่สามารถแก้ไขได้');";
		echo "window.location.href = 'manage.php';";
		echo "</script>";
	}
?>