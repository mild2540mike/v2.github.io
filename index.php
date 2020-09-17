<?php 
	include('admin/include/header.php');
	include('admin/include/conn.php');
	include('admin/include/thaidate.php');
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<script src="include/jquery-3.3.1.min.js"></script>
		<script>
			$(document).ready(function(){
				setInterval(function(){
					$('#time').load('time.php')
				},100);
			});
		</script>
	</head>
	<style>
		body{
			background-color:#BEBEBE;
			background-size: cover;
		}
		.box{
			margin: auto;
			width: 40%;
			border: 10px solid #787878;
			padding: 20px;
			background-color: #f0f0f0
		}
		div{
			padding: 10px;
		}
		img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 40%;
		}
		input{
			height: 80px;
			font-size: 32px;
		}
		p{
			font-size: 24px;
		}
		b{
			font-size: 18px;
		}
	
	</style>
	<body>
	<div></div>
	<div></div>
	<div></div>
		<div class="box">
			<div>
				<img src="assets/img/logo1.png"/>
				<br>
				
				<p style="text-align: center;"><b><?php echo thai_date($thtime); ?></b></p>
				<b><div style="text-align: center;" id="time"></div> </b>
			</div>

			<div>
			<form action="logout.php">
			<button onclick="window.location.href='login.php'" type="button" class="btn btn-info btn-block rounded-pill">เจ้าหน้าที่วัสดุ</button>
			</div>
			
			<div>
			<button onclick="window.location.href='./user/ceo.php'" type="button" class="btn btn-success btn-block rounded-pill">รายงานผู้บริหาร</button>	
			</div>
	</body>
</html>