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
		<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
	</head>
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
			padding-left: 10px;
			padding-right: 10px;
		}
     a {
  color: dimgray;

    }
    a:link {
  text-decoration: none;

    }
    a:hover {
  color: black;
   }
	</style>
	<body>
	<div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>ออกรายงาน</b></div>
	
    <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item "><a href="report.php">จัดการ</a></li>
              <li class="breadcrumb-item "><a href="report_wait.php">รอผลจากผู้บริหาร</a></li>
              <li class="breadcrumb-item "><a href="report_complete.php">ประเมินผลแล้ว</a></li>
    </div><!-- /.col -->
    <div align="right"><button onclick="window.location.href='report_search.php'" type="button" class="btn btn-warning btn-lg"><b>ค้นหารายการ</b></button></div>
		
	
	<div class="table">
	<table class="table table-hover table-light">
  <thead class="thead thead-dark">
    <tr>
     <th scope="col" width="5%">ลำดับ</th>
      <th scope="col" width="10%">ภาพวัสดุ</th>
      <th scope="col" width="14%">ชื่อประเภท</th>
      <th scope="col" width="10%">การประเมิน</th>
      <th scope="col" width="9%">ราคาต่อหน่วย</th>
      <th scope="col" width="10%">มูลค่าคงเหลือ</th>
      <th scope="col" width="7%">ราคาซ่อม</th>
      <th scope="col" width="7%">วิธีการได้มา</th>
      <th scope="col" width="8%">อายุ(ปี : ปัจจุบัน)</th>
      <th scope="col">(ว/ด/ป) จำหน่าย</th>
      <th scope="col" width="10%">(ว/ด/ป) ส่งของ</th>
    </tr>
  </thead>
  <tbody>
    <?php
					//Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
                    $sql = "SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                    LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc 
                    LEFT JOIN tb_bill ON tb_bill.id_bill=tb_da.id_item 
                    LEFT JOIN tb_type ON tb_type.id_type=tb_bill.id_bill 
                    LEFT JOIN tb_fix ON tb_fix.id_fix=tb_type.id_type 
                    LEFT JOIN image ON image.id=tb_fix.id_fix 
                    LEFT JOIN tb_dep ON tb_dep.id_dep=image.id
                    LEFT JOIN tb_cal ON tb_cal.id_type=tb_dep.id_dep

                    WHERE tb_fix.fix_status='ชำรุด' AND tb_dep.dep_status='ใช้งานปกติ' ORDER BY sid DESC";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                      if ($row["how_to"] == "ตกลงราคา") {
                        $bg = "success";
                      } elseif ($row["how_to"] == "บริจาค") {
                        $bg = "info";
                      } elseif ($row["how_to"] == "") {
                        $bg = "warning";
                      } else {
                        $bg = "";
                      }

                      if ($row["status"] == "รอผลจากผู้บริหาร") {
                        $bg1 = "primary";
                      } elseif ($row["status"] == "ไม่อนุมัติ") {
                        $bg1 = "danger";
                      } elseif ($row["status"] == "") {
                        $bg1 = "warning";
                      } else {
                        $bg1 = "";
                      }

                      ?>
                        <tr>
                          <td><?php echo $row['id_doc']; ?></td>
                          <td><img src="../admin/image/<?php echo $row['img_name']; ?>" width="100px" height="100px"></td>
                          <td><?php echo $row['name_type'].'<br>ยี่ห้อ : '. $row['brand']; ?></td>
                          <td><span class="badge badge-<?php echo $bg1; ?> badge-pill"><?php echo $row["status"]; ?></span></td>
                          <td><?php echo number_format($row['price']); ?></td>
                          <td><?php echo number_format($row['dep_del']); ?></td>
                          <td><?php echo number_format($row['price_fix']); ?></td>
                          <td><span class="badge badge-<?php echo $bg; ?> badge-pill"><?php echo $row["how_to"]; ?></span></td>
                          <td ><?php echo number_format($row['dep_now']); ?></td>
                          <td ><?php echo $row['year']; ?></td>
                          <td><?php echo $row['date_item']; ?></td>
                        </tr>
                      <?php
                    }
                  ?>

  </tbody>
</table>

	</body>
</html>