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
	</head>
	<style>
		body{
			background-color:#BEBEBE;
			background-size: cover;
		}
		.box{
			margin: auto;
			width: 500px;
			border-radius: 30px;
			padding: 50px;
			background-color: #ffffff
		}
		input{
			height: 40px;
			width: auto;
			font-size: 15px;
		}
		div{
			padding: 10px;
		}
		b{
			font-size:40px; 
		}
		.space{
			padding: 50px;
		}
		
	</style>
	<body>
	<div class="space"></div>
		<div class="box">
			<form action="check_login.php" method="post">
			<div>
				<div style="text-align: center;">
					<b>เข้าสู่ระบบ</b>
				</div>
				
				<div >
					<div>
			        	<input type="text" id="username" name="username" placeholder="ชื่อผู้ใช้" class="input-group" style="text-align: center;" required>	
			      	</div>
			      	<div>
			        	<input type="password" id="password" name="password" placeholder="รหัสผ่าน" class="input-group" style="text-align: center;" required>	
			      	</div>
				</div>

				<div style="text-align: center;">
					<button type="submit" class="btn btn-success btn-block">เข้าสู่ระบบ</button>
				</div>
				<div style="text-align: center;">
					<button onclick="window.location.href='index.php'"  type="button" class="btn btn-danger btn-block">ยกเลิก</button>
				</div>
				</div>
			</form>
	</body>
</html>