<?php
	include('include/conn.php');
	if (isset($_FILES["image"]["name"]))
        {
            $img=$_FILES['image']['name'];
            $path="image/";
            move_uploaded_file($_FILES['image']['tmp_name'], $path.$img);
        }else{
            echo "อัพโหลดไม่สำเร็จ";
}
	
	$id_fix = $_POST['id_fix'];
	$id_type = $_POST['id_type'];
	$id_item = $_POST['id_item'];
	$id_doc = $_POST['id_doc'];
	$id_bill = $_POST['id_bill'];
	$id_dep = $_POST['id_dep'];

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


	//table1 tb_fix
	$sql1="INSERT INTO tb_fix(id_fix, fix_status) VALUES ('$id_fix','$fix_status')";
	$result = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error());
	//table2 tb_type
	$sql2="INSERT INTO tb_type(id_type, name_type, brand) VALUES ('$id_type','$name_type','$brand')";
 	$result1 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error());
 	//table3 tb_da
 	$sql3="INSERT INTO tb_da(id_item, price, how_to, use_to) VALUES ('$id_item','$price','$how_to','$use_to')";
 	$result2 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error());
	//table4 tb_doc
 	$sql4="INSERT INTO tb_doc(id_doc, note, date_item, id_department) VALUES ('$id_doc','$note','$date_item','$id_department')";
 	$result3 = mysqli_query($conn, $sql4) or die ("Error in query: $sql4 " . mysqli_error());
 	//table5 tb_bill
 	$sql5="INSERT INTO tb_bill(id_bill, num_d, c_list, Proof_pay) VALUES ('$id_bill','$num_d','$c_list','$Proof_pay')";
 	$result4 = mysqli_query($conn, $sql5) or die ("Error in query: $sql5 " . mysqli_error());
 	//table6 tb_dep
	$sql6="INSERT INTO tb_dep(id_dep) VALUES ('$id_dep')";
 	$result5 = mysqli_query($conn, $sql6) or die ("Error in query: $sql6 " . mysqli_error());
 	//table7 tb_dep
 	$sql7="INSERT INTO image(img_name) VALUES ('$img')";
 	$result6 = mysqli_query($conn, $sql7) or die ("Error in query: $sql7 " . mysqli_error());


	mysqli_close($conn);

	if($result||$result1||$result2||$result3||$result4||$result5||$result6){
		echo "<script type='text/javascript'>";
		echo "alert('เพิ่มข้อมูลสำเร็จ');";
		echo "window.location.href = 'manage.php';";
		echo "</script>";
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('ไม่สามารถเพิ่มรายชื่อได้');";
		echo "window.location.href = 'manage.php';";
		echo "</script>";
	}
	
?>