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

	table {
		font-size: 18px;
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
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#image').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
			
		}
	}
</script>

<body>
	<form name="form" action="manage_add_process.php" method="post" enctype="multipart/form-data">
		<div class="container">

			<div class="row">
				<div class="col"></div> <!-- พื้นที่ซ้าย -->

				<div id="addform" class="col-12">
					<!-- พื้นที่กลาง -->
					<div style="text-align: center;"><b style="font-size: 24px;">กรอกข้อมูลวัสดุ</b></div>
					<div>
						<input type="hidden" id="id_fix" name="id_fix" placeholder="รหัสการซ่อม" class="input-group" style="text-align: center;" required>
						<input type="hidden" id="id_type" name="id_type" placeholder="รหัสประเภท" class="input-group" style="text-align: center;" required>
						<input type="hidden" id="id_item" name="id_item" placeholder="รหัสจัดการวัสดุ" class="input-group" style="text-align: center;" required>
						<input type="hidden" id="id_doc" name="id_doc" placeholder="รหัสจัดการ" class="input-group" style="text-align: center;" required>
						<input type="hidden" id="id_bill" name="id_bill" placeholder="รหัสบิลล์" class="input-group" style="text-align: center;" required>
						<input type="hidden" id="id_dep" name="id_dep" placeholder="รหัสค่าเสื่อม" class="input-group" style="text-align: center;" required>

					</div>

					<div class="panel-body">
						<div class="form">
							<form class="form-validate form-horizontal" id="feedback_form" method="get" action="" novalidate="novalidate">
								<div class="form-group ">
									<label for="cname" class="control-label col-lg-2">วันเดือนปี ที่ส่งของ <span class="required">*</span></label>
									<div class="col-lg-10">
										<input class="form-control error" id="date_item" name="date_item" minlength="5" type="date" required=""><label for="cname" class="error">11-10-2012.</label>
									</div>
								</div>
								<div class="formgroup col-md-12 input-group">
									<h4>อัพไฟล์รูปภาพ</h4>
									</span>
									<div class="formgroup col-md-12 input-group">
										<label for="image"></label><input type="file" class="form-control" name="image" onchange="readURL(this);">
										<img id="image" src="http://localhost/v2/assets/img/DefaultIMG.jpg" alt="your image"style="padding-top: 15px; padding-left: 37%; width: 650px; height: 275px "/>
									</div>
								
									<p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
									<div class="form-group ">
										<label for="cemail" class="control-label col-lg-2">ชื่อประเภท <span class="required">*</span></label>
										<div class="col-lg-10">
											<input class="form-control  error" id="name_type" type="text" name="name_type" required=""><label for="cemail" class="error">เครื่องวัดความดันโลหิต.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="brand" class="control-label col-lg-2">ยี่ห้อ </label>
										<div class="col-lg-10">
											<input class="form-control  error" id="brand" type="text" name="brand" required=""><label for="cemail" class="error">HEM-7200.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="id_department" class="control-label col-lg-2">รหัสหน่วยงานปี <span class="required">*</span></label>
										<div class="col-lg-10">
											<input class="form-control  error" id="id_department" type="text" name="id_department" required=""><label for="cemail" class="error">845501.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="num_d" class="control-label col-lg-2">เลขที่เอกสาร </label>
										<div class="col-lg-10">
											<input class="form-control  error" id="num_d" name="num_d" required=""></input><label for="ccomment" class="error">ใบสั่งซื้อ 088-1304.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="Proof_pay" class="control-label col-lg-2">หลักฐานการจ่าย </label>
										<div class="col-lg-10">
											<select class="form-control  error" id="Proof_pay" name="Proof_pay" required="">
												<option value="ใบเสร็จ">ใบเสร็จ</option>
											</select>
											<label for="ccomment" class="error">ใบเสร็จ.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="c_list" class="control-label col-lg-2">รายการเปลี่ยนแปลง </label>
										<div class="col-lg-10">
											<select class="form-control  error" id="c_list" name="c_list" required="">
												<option value="ใบเบิก">ใบเบิก</option>
											</select>
											<label for="ccomment" class="error">ใบเบิก.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="note" class="control-label col-lg-2">หมายเหตุ </label>
										<div class="col-lg-10">
											<textarea class="form-control  error" type="textarea" id="note" name="note"></textarea><label for="ccomment" class="error">ใช้ในราชกาล.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="price" class="control-label col-lg-2">ราคาต่อหน่วย </label>
										<div class="col-lg-10">
											<input class="form-control  error" id="price" name="price" required=""></input><label for="ccomment" class="error">180,000.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="how_to" class="control-label col-lg-2">วิธีการได้มา </label>
										<div class="col-lg-10">
											<select class="form-control  error" id="how_to" name="how_to" required="">
												<option selected>
												<option value="บริจาค">บริจาค</option>
												<option value="ตกลงราคา">ตกลงราคา</option>
											</select>
											<label for="ccomment" class="error">บริจาค.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="use_to" class="control-label col-lg-2">ใช้ประจำ </label>
										<div class="col-lg-10">
											<input class="form-control  error" id="use_to" name="use_to" required=""></input><label for="ccomment" class="error">ตึก ETC ชั้น 1.</label>
										</div>
									</div>
									<div class="form-group ">
										<label for="fix_status" class="control-label col-lg-2">สถานะ </label>
										<div class="col-lg-10">
											<select class="form-control  error" id="fix_status" name="fix_status" required="">
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
	</form>


</body>

</html>