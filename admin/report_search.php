<?php 
	include('include/conn.php');
	include('include/thaidate.php');
	include('include/navbar.php')
?>
<!DOCTYPE html>
<html>
	<head>
		<style> 
input[type=text] {
  width: 100px;
 
}


</style>

		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<script src="include/jquery-3.3.1.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#txtsearch").keyup(function(){
					$("#selectdata").load("report_search_process.php",
					{
						search: $("#txtsearch").val()
					});
				});
			});

		</script>
		<form> 
		  	
		</form>
  		

		<H3>โรงพยาบาลจิตเวชนครราชสีมาราชนครินทร์</H3>
		<p style="text-align: center;"><b><?php echo thai_date($thtime); ?></b></p>
		<H5 style="text-align: center;">รายงานคาดการวัสดุที่จะจำหน่าย</H5>

	<style>
		body{
			background-color:#BEBEBE;
			background-size: cover;
		}
		div{
			padding:5px;
		}
		table{
			font-size: 16px;
		}
		div.table{
			padding-left: 5px;
			padding-right: 5px;
		}
		h3 {
 			text-align: center;
		}
	</style>

	<body>
	<div id="selectdata"><b>หมายเหตุ : </b>ค้นหาปีที่คาดการว่าจะหมดอายุล่วงหน้า (YYYY-MM-DD)</div>
			<div>
			ค้นหา : <input type="text" id="txtsearch" name="search"><br>
			</div>
	</body>
</html>