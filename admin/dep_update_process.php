<?php
	include('include/conn.php');
	
	$id_type = $_POST['id_type'];
	$id_item = $_POST['id_item'];
	$id_doc = $_POST['id_doc'];
	$id_dep = $_POST['id_dep'];

	$name_type = $_POST['name_type'];
	$brand = $_POST['brand'];
	$date_item = $_POST['date_item'];
	$price = $_POST['price'];
	$dep_age = $_POST['dep_age'];
	$year = $_POST['year'];
	$dep_status = $_POST['dep_status'];

	//$dep_pa = $_POST['dep_pa'];
	//$dep_del = $_POST['dep_del'];
	
	//$dep_pa = $dep_y * $dep_age;
	//$dep_del = $price - $dep_pa;

	$sql1="UPDATE tb_type SET name_type='".$name_type."' ,brand='".$brand."' WHERE id_type = '".$id_type."'";
	$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error());

	$sql2="UPDATE tb_doc SET date_item='".$date_item."' WHERE id_doc = '".$id_doc."'";
	$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error());

	$sql3="UPDATE tb_da SET price='".$price."' WHERE id_item = '".$id_item."'";
	$result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error());

	$sql4="UPDATE tb_dep SET dep_status='".$dep_status."',year='".$year."', dep_age='".$dep_age."' WHERE id_dep = '".$id_dep."'";
	$result4 = mysqli_query($conn, $sql4) or die ("Error in query: $sql4 " . mysqli_error());


	mysqli_close($conn);
	$result=mysqli_query($conn,$sql);
	if($result1||$result2||$result3||$result4){   
		echo "<script type='text/javascript'>";      
		echo "alert('เพิ่มข้อมูลสำเร็จ');";
		echo "window.location.href = 'dep.php';";
		echo "</script>";                               //  ประกาศ echo จะไม่ติด Error          
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('ไม่สามารถเพิ่มข้อมูลได้');";
		echo "window.location.href = 'dep.php';";
		echo "</script>";
	}
?>
