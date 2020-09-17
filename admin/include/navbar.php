<?php 
	include('include/conn.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	</head>
	<style>
		a{
			font-size: 20px;
		}
		a.navbar-brand{
			font-size: 25px;
		}
		div{

		}
	</style>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			  <a class="navbar-brand" href="index.php"><i style='font-size:24px'></i> หน้าหลัก</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNavDropdown">
			    <ul class="navbar-nav">
			    
			      <li class="nav-item ">
			        <a class="nav-link" href="manage.php">จัดการวัสดุ<span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="fix.php">จัดการซ่อม</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="dep.php">จัดการค่าเสื่อม</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="report.php">ออกรายงาน</a>
			      </li>
			      <li class="nav-item">
			      <div>
					  <a class="btn btn-secondary"  href="../index.php" role="button" id="dropdownMenuLink"><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a></div>
			      </li>
		    </ul>
		  </div>
		</nav>
	</body>
</html>