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
		 <script type="text/javascript">
        function GetDays(){
        var dropdt = new Date(document.getElementById("year").value);
        var pickdt = new Date(document.getElementById("date_item").value);
        return parseInt((dropdt - pickdt) / (8760 * 3600 * 1000));
        }
        function cal(){
        if(document.getElementById("year")){
        document.getElementById("dep_age").value=GetDays();
        }
        }
        </script>
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
		<form action="dep_update_process.php" method="post">
			<div class="container">
				
				<?php
				$id_type= $_GET['id_dep'];

				$sql="SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc
                            LEFT JOIN tb_type ON tb_type.id_type=tb_da.id_item
                            LEFT JOIN tb_dep ON tb_dep.id_dep=tb_type.id_type
                            LEFT JOIN image ON image.id=tb_dep.id_dep
                             WHERE id_dep =".$id_type." ORDER BY sid DESC";
				$result =$conn->query($sql);
				$row=$result->fetch_assoc();
				
				?>
				
				<div class="row">
					<div class="col"></div> <!-- พื้นที่ซ้าย -->
    				<div class="col-8 border border-dark "> <!-- พื้นที่กลาง -->
    					<div style="text-align: center;"><b style="font-size: 25px;">แก้ไขข้อมูลค่าเสื่อม</b></div>
						<div>
				        	<input type="hidden" id="id_item" name="id_item" placeholder="รหัสitem" value="<?php echo $row['id_item'];?>" class="input-group" style="text-align: center;" required>
				        	<input type="hidden" id="id_type" name="id_type" placeholder="รหัสtype" value="<?php echo $row['id_type'];?>" class="input-group" style="text-align: center;" required>
				        	<input type="hidden" id="id_doc" name="id_doc" placeholder="รหัสdoc" value="<?php echo $row['id_doc'];?>" class="input-group" style="text-align: center;" required>
				        	<input type="hidden" id="id_dep" name="id_dep" placeholder="รหัสdep" value="<?php echo $row['id_dep'];?>" class="input-group" style="text-align: center;" required>
				      	</div>
						   <div align="center"><img src="../admin/image/<?php echo $row['img_name']; ?>" width="200px" height="200px"></div>
						   
				      	<div>
				        	ชื่อประเภท<input type="text" id="name_type" readonly="readonly" name="name_type" placeholder="กรอกข้อมูล" value="<?php echo $row['name_type'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      	<div>
				        	ยี่ห้อ ขนาด<input type="text" id="brand" name="brand" readonly="readonly" value="<?php echo $row['brand'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      	<div>
				        	ราคาต่อหน่วย<input type="text" id="price" name="price" readonly="readonly" value="<?php echo $row['price'];?>" class="form-control" style="text-align: center;" required>	
				      	</div>
				      	<div>
				      		สถานะวัสดุ<select class="form-control" name="dep_status" id="dep_status">
		                        <option value="ใช้งานปกติ" selected>ใช้งานปกติ</option>
		                        <option value="จำหน่าย">จำหน่าย</option>
		                      </select>
		                </div>
				      	<div>
				      		วันที่ซื้อมา<input class="form-control" readonly="readonly" value="<?php echo $row['date_item'];?>" id="date_item" name="date_item" onchange="cal()">
				      	</div>
				      	<div>
				      		สินสุดอายุไข<input type="date" class="form-control" id="year" name="year" value="<?php echo $row['year'];?>" onchange="cal()"/>
				      	</div>
				      	<div>
				      		ผลลัพธ์ : ปี<input type="text" class="form-control" readonly="readonly" id="dep_age" name="dep_age" value="<?php echo $row['dep_age'];?>" name="numdays"/>
				      	</div>
		                <br>
		                <br>
				      	
				      	<div style="text-align: center;">
							<button type="submit" class="btn btn-success btn-block">บันทึก</button>
						</div>
						<div style="text-align: center;">
							<button onclick="window.location.href='dep.php'"  type="button" class="btn btn-outline-danger btn-block">ยกเลิก</button>
						</div>
			      	</div>
			      	
			      	<div class="col"></div> <!-- พื้นที่ขวา -->
			      	
				</div>
				
				
				</div>
			</form>
	
		
	</body>
</html>