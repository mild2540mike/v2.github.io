<?php 
	
	include('include/conn.php');
	include('include/thaidate.php');
	include('include/navbar.php')
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	</head>
	<style>
	
		div{
			padding:10px;
		}
		input{
			height: 50px;
			font-size: 18px;
		}
		select{
			text-align-last: center;
		}
	</style>
	<body>
		<form action="fix_update_process.php" method="post">
			<div class="container">
				
				<?php
				$id_fix= $_GET['id_fix'];
				$sql="SELECT * FROM tb_fix WHERE id_fix='".$id_fix."'";
				$result =$conn->query($sql);
				$row=$result->fetch_assoc();
				
				?>
				
				<div class="row">
					<div class="col"></div> <!-- พื้นที่ซ้าย -->
    				<div class="col-8 border border-dark "> <!-- พื้นที่กลาง -->
    					<div style="text-align: center;"><b style="font-size: 20px;">อัพเดทข้อมูลการซ่อม</b></div>
				      <input type="hidden" id="id_fix" name="id_fix" placeholder="รหัสการซ่อม" value="<?php echo $row['id_fix'];?>" class="input-group" style="text-align: center;" required>
				      	<div>
				        	ชื่อ-สกุลผู้แจ้ง<input type="text" id="dname" name="dname" placeholder="กรอกข้อมูล" value="<?php echo $row['dname'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      		<div>
				        	วันที่แจ้งซ่อม<input type="date" id="date_fix" name="date_fix" placeholder="กรอกข้อมูล" value="<?php echo $row['date_fix'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      	<div>
				        	อาการเสีย<input type="text" id="break_d" name="break_d" placeholder="กรอกข้อมูล" value="<?php echo $row['break_d'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      	<div>
				      		การประเมินผล<select class="form-control" name="status" id="status" required>
		                        <option value="รอผลจากผู้บริหาร" selected>รอผลจากผู้บริหาร</option>
		                        <option value="อนุมัติ">อนุมัติ</option>
		                        <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
		                      </select>
		                </div>
		                <div>
				      		สถานะวัสดุ<select class="form-control" name="dep_status" id="dep_status" required>
		                        <option value="ใช้งานปกติ" selected>ใช้งานปกติ</option>
		                        <option value="จำหน่าย">จำหน่าย</option>
		                      </select>
		                </div>
				      	<div>
				        	ราคาซ่อม<input type="text" id="price_fix" name="price_fix" placeholder="ค่าซ่อม" value="<?php echo $row['price_fix'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      	<div style="text-align: center;">
							<button type="submit" class="btn btn-success btn-block">บันทึก</button>
						</div>
						<div style="text-align: center;">
							<button onclick="window.location.href='fix.php'"  type="button" class="btn btn-danger btn-block">ยกเลิก</button>
						</div>
			      	</div>
			      	
			      	<div class="col"></div> <!-- พื้นที่ขวา -->
			      	
				</div>
				
				
				</div>
			</form>
	
		
	</body>
</html>