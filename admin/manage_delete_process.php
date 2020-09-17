<?php
	include('include/conn.php');
	
	$id_type=isset($_GET['id_type']) ? $_GET['id_type']:'';
	$sql="DELETE tb_type,tb_fix,tb_doc,tb_dep,tb_da,tb_bill,image FROM tb_type
		INNER JOIN  tb_fix ON tb_fix.id_fix = tb_type.id_type
		INNER JOIN  tb_doc ON tb_doc.id_doc = tb_type.id_type
		INNER JOIN  tb_dep ON tb_dep.id_dep = tb_type.id_type
		INNER JOIN  tb_da ON tb_da.id_item = tb_type.id_type
		INNER JOIN  tb_bill ON tb_bill.id_bill = tb_type.id_type
		INNER JOIN  image ON image.id = tb_type.id_type

		WHERE id_type='".$id_type."'";
						
	$result=mysqli_query($conn,$sql);
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('ลบรายชื่อสำเร็จ');";
		echo "window.location.href = 'manage.php';";
		echo "</script>";
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('ไม่สามารถลบรายชื่อได้');";
		echo "window.location.href = 'manage.php';";
		echo "</script>";
	}
	
?>