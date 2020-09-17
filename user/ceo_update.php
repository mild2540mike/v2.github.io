<?php

include('include/conn.php');
include('include/thaidate.php');

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<style>
	body {
		background-color: teal;
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
	<form action="ceo_update_process.php" method="post">
		<div class="container">

			<?php
			$id_type = $_GET['id_fix'];

			$sql = "SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc 
                            LEFT JOIN tb_bill ON tb_bill.id_bill=tb_da.id_item 
                            LEFT JOIN tb_type ON tb_type.id_type=tb_bill.id_bill 
                            LEFT JOIN tb_fix ON tb_fix.id_fix=tb_type.id_type
                            LEFT JOIN tb_cal ON tb_cal.id_type=tb_fix.id_fix
                            LEFT JOIN image ON image.id=tb_cal.id_type

                             WHERE id_fix =" . $id_type . " ORDER BY sid DESC";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			
			if ($row["how_to"] == "ตกลงราคา") {
				$bg = "success";
			  } elseif ($row["how_to"] == "บริจาค") {
				$bg = "info";
			  } elseif ($row["how_to"] == "") {
				$bg = "warning";
			  } else {
				$bg = "";
			  }

			$a = $row['dep_now'];
			$b = $row['dep_age'];
			$c = $b - $a;

          if ($row["how_to"] == "ตกลงราคา") {
            $bg = "success";
          } elseif ($row["how_to"] == "บริจาค") {
            $bg = "info";
          } elseif ($row["how_to"] == "") {
            $bg = "warning";
          } else {
            $bg = "";
          }
			?>
			<div class="card">

				<div class="card-header">
					<div align="right"><a href="ceo.php" class="btn btn-danger">X</a></div>
					<div align="center">
						<h4 class="card-title"><strong>รายละเอียดวัสดุ</strong></h4>
					</div>
					<div class="card-body">
						<div align="center">
							<img src="../admin/image/<?php echo $row['img_name']; ?>" width="300px" height="300px"></div>
						<br>
						<br>
						<h5 class="card-title"><b>รหัสหน่วยงาน ปีที่ซื้อ </b> ( <?php echo $row['id_department']; ?> )</h5>
						<div>
							<p class="card-text"><b>ชื่อประเภท : </b> <?php echo $row['name_type'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ยี่ห้อ</b> : ' . $row['brand']; ?>

								<p class="card-text"><b>การประเมินการซ่อม : </b> <?php echo $row['status']; ?>
									<p class="card-text"><b>วิธีการได้มา : </b> <span class="badge badge-<?php echo $bg; ?> badge-pill"><?php echo $row["how_to"]; ?></span>
										<p class="card-text"><b>อายุการใช้งานคงเหลือ : </b> <?php echo $c; ?> ปี
											<p class="card-text"><b>ราคาซ่อม : </b> <?php echo number_format($row['price_fix']); ?> บาท
												<p class="card-text"><b>ราคาต่อหน่วย : </b> <?php echo number_format($row['price']); ?> บาท
													<p class="card-text"><b>มูลค่าคงเหลือ : </b> <?php echo number_format($row['dep_del']); ?> บาท


						</div>

	</form>


</body>

</html>