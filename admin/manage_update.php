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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
	body {
		background-color: #BEBEBE;
		background-size: cover;
	}

	div {
		padding: 10px;
	}

	input {
		height: 40px;
		font-size: 18px;
	}

	select {
		text-align-last: center;
	}

	#addform {
		background-color: #ffffff;
	}
</style>

<body>
	<form action="manage_update_process.php" method="post">
		<div class="container">

			<?php
			$id_type = $_GET['id_fix'];

			$sql = "SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc 
                            LEFT JOIN tb_bill ON tb_bill.id_bill=tb_da.id_item 
                            LEFT JOIN tb_type ON tb_type.id_type=tb_bill.id_bill 
                            LEFT JOIN tb_fix ON tb_fix.id_fix=tb_type.id_type
                            LEFT JOIN image ON image.id=tb_fix.id_fix
                             WHERE id_fix =" . $id_type . " ORDER BY sid DESC";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			?>


			<form name="form" action="manage_add_process.php" method="post" enctype="multipart/form-data">
				<div class="container">

					<div class="row">
						<div class="col"></div> <!-- พื้นที่ซ้าย -->

						<div id="addform" class="col-12">
							<!-- พื้นที่กลาง -->
							<div style="text-align: center;"><b style="font-size: 24px;">แก้ไขข้อมูลวัสดุ</b></div>
							<div>

								<div align="center"><img src="../admin/image/<?php echo $row['img_name']; ?>" width="200px" height="200px"></div>
								<input type="hidden" id="id_fix" name="id_fix" placeholder="รหัสการซ่อม" value="<?php echo $row['id_fix']; ?>" class="input-group" style="text-align: center;" required>
								<input type="hidden" id="id_type" name="id_type" placeholder="รหัสประเภท" value="<?php echo $row['id_type']; ?>" class="input-group" style="text-align: center;" required>
								<input type="hidden" id="id_item" name="id_item" placeholder="รหัสจัดการวัสดุ" value="<?php echo $row['id_item']; ?>" class="input-group" style="text-align: center;" required>
								<input type="hidden" id="id_doc" name="id_doc" placeholder="รหัสจัดการ" value="<?php echo $row['id_doc']; ?>" class="input-group" style="text-align: center;" required>
								<input type="hidden" id="id_bill" name="id_bill" placeholder="รหัสบิลล์" value="<?php echo $row['id_bill']; ?>" class="input-group" style="text-align: center;" required>

							</div>

							<div class="form-row">

							</div>



							<div class="panel-body">
								<div class="form">
									<form class="form-validate form-horizontal" id="feedback_form" method="get" action="" novalidate="novalidate">
										<div class="form-group ">
											<label for="cname" class="control-label col-lg-2">วันเดือนปี ที่ส่งของ <span class="required">*</span></label>
											<div class="col-lg-10">
												<input class="form-control error" id="date_item" name="date_item" value="<?php echo $row['date_item']; ?>" minlength="5" type="date" required=""><label for="cname" class="error">11-10-2012.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="cemail" class="control-label col-lg-2">ชื่อประเภท <span class="required">*</span></label>
											<div class="col-lg-10">
												<input class="form-control  error" id="name_type" type="text" name="name_type" value="<?php echo $row['name_type']; ?>" required=""><label for="cemail" class="error">เครื่องวัดความดันโลหิต.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="brand" class="control-label col-lg-2">ยี่ห้อ </label>
											<div class="col-lg-10">
												<input class="form-control  error" id="brand" type="text" name="brand" value="<?php echo $row['brand']; ?>" required=""><label for="cemail" class="error">HEM-7200.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="id_department" class="control-label col-lg-2">รหัสหน่วยงานปี <span class="required">*</span></label>
											<div class="col-lg-10">
												<input class="form-control  error" id="id_department" type="text" name="id_department" value="<?php echo $row['id_department']; ?>" required=""><label for="cemail" class="error">845501.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="num_d" class="control-label col-lg-2">เลขที่เอกสาร </label>
											<div class="col-lg-10">
												<input class="form-control  error" id="num_d" name="num_d" value="<?php echo $row['num_d']; ?>" required=""></input><label for="ccomment" class="error">ใบสั่งซื้อ 088-1304.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="Proof_pay" class="control-label col-lg-2">หลักฐานการจ่าย </label>
											<div class="col-lg-10">
												<select class="form-control  error" value="<?php echo $row['Proof_pay']; ?> " id="Proof_pay" name="Proof_pay" required="">
													<option value="<?php echo $row['Proof_pay']; ?>" selected><?php echo $row['Proof_pay']; ?></option>
												</select>
												<label for="ccomment" class="error">ใบเสร็จ.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="c_list" class="control-label col-lg-2">รายการเปลี่ยนแปลง </label>
											<div class="col-lg-10">
												<select class="form-control  error" value="<?php echo $row['c_list']; ?> " id="c_list" name="c_list" required="">
													<option value="<?php echo $row['c_list']; ?>" selected><?php echo $row['c_list']; ?></option>
												</select>
												<label for="ccomment" class="error">ใบเบิก.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="note" class="control-label col-lg-2">หมายเหตุ </label>
											<div class="col-lg-10">
												<textarea class="form-control  error" type="textarea" id="note" name="note" value="<?php echo $row['note']; ?>" ></textarea><label for="ccomment" class="error">ใช้ในราชกาล.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="price" class="control-label col-lg-2">ราคาต่อหน่วย </label>
											<div class="col-lg-10">
												<input class="form-control  error" id="price" name="price" value="<?php echo number_format($row['price']); ?>" required=""></input><label for="ccomment" class="error">180,000.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="how_to" class="control-label col-lg-2">วิธีการได้มา </label>
											<div class="col-lg-10">
												<select class="form-control  error" id="how_to" name="how_to" value="<?php echo $row['how_to']; ?>" required="">
													<option value="<?php echo $row['how_to']; ?>" selected><?php echo $row['how_to']; ?></option>
													<option value="บริจาค">บริจาค</option>
													<option value="ตกลงราคา">ตกลงราคา</option>
												</select>
												<label for="ccomment" class="error">บริจาค.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="use_to" class="control-label col-lg-2">ใช้ประจำ </label>
											<div class="col-lg-10">
												<input class="form-control  error" id="use_to" name="use_to" value="<?php echo $row['use_to']; ?>" required=""></input><label for="ccomment" class="error">ตึก ETC ชั้น 1.</label>
											</div>
										</div>
										<div class="form-group ">
											<label for="fix_status" class="control-label col-lg-2">สถานะ </label>
											<div class="col-lg-10">
												<select class="form-control  error" id="fix_status" name="fix_status" value="<?php echo $row['fix_status']; ?>" required="">
													<option value="" selected> - เลือก - </option>
													<option value="ชำรุด">ชำรุด</option>
													<option value="ใช้งานปกติ">ใช้งานปกติ</option>
												</select>
												<label for="ccomment" class="error">ใช้งานปกติ.</label>
											</div>
										</div>





										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-10">
												<button class="btn btn-primary" type="submit">Save</button>
												<button class="btn btn-default" type="button" onclick="window.location.href='manage.php'">Cancel</button>
											</div>
										</div>
									</form>
								</div>

							</div>
						</div>




						<div class="col"></div> <!-- พื้นที่ขวา -->

					</div>


				</div>

			</form>



</body>

</html>