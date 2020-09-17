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
	<div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>รายการรอประเมินผล</b></div>
	         <!-- link/link -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item "><a href="report.php">จัดการ</a></li>
              <li class="breadcrumb-item "><a href="report_wait.php">รอผลจากผู้บริหาร</a></li>
              <li class="breadcrumb-item "><a href="report_complete.php">ประเมินผลแล้ว</a></li>
          </div><!-- /.col -->

	<div class="table">
	<table class="table table-hover table-light">
  <thead class="thead thead-dark">
    <tr>
      <th scope="col" width="1%">ลำดับ</th>
      <th scope="col" width="14%">ชื่อประเภท</th>
      <th scope="col" width="14%">ยี่ห้อ ขนาด</th>
      <th scope="col" width="10%">สถานะ</th>
      <th scope="col" width="10%">อายุ(ปี : ปัจจุบัน)</th>
      <th scope="col" width="10%">ราคาต่อหน่วย</th>
      <th scope="col" style="text-align: center;" width="14%">มูลค่าคงเหลือ</th>
      <th scope="col" width="10%">สถานะ</th>
      <th scope="col" width="10%">(ว/ด/ป) ส่งของ</th>
      <th scope="col" width="10%">(ว/ด/ป) จำหน่าย</th>
    </tr>
  </thead>
  <tbody>

    <?php
                    $sql = "SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                    LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc 
                    LEFT JOIN tb_bill ON tb_bill.id_bill=tb_da.id_item 
                    LEFT JOIN tb_type ON tb_type.id_type=tb_bill.id_bill 
                    LEFT JOIN tb_fix ON tb_fix.id_fix=tb_type.id_type 
                    LEFT JOIN image ON image.id=tb_fix.id_fix 
                    LEFT JOIN tb_dep ON tb_dep.id_dep=image.id
                    LEFT JOIN tb_cal ON tb_cal.id_type=tb_dep.id_dep

                    WHERE tb_fix.fix_status='ชำรุด' AND tb_dep.dep_status='ใช้งานปกติ' AND tb_fix.status='รอผลจากผู้บริหาร' ORDER BY sid DESC";
                       
                            //$dep_d = date("Y-m-d");

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['sid']; ?></td>
                          <td><?php echo $row['name_type']; ?></td>
                          <td><?php echo $row['brand']; ?></td>
                          <td><?php echo $row['status']; ?></td>
                          <td align="center"><?php echo $row['dep_now']; ?></td>
                          <td><?php echo number_format($row['price']); ?></td>
                          <td style="text-align: center;"><?php echo number_format($row['dep_del']); ?></td>
                          <td><?php echo $row['dep_status']; ?></td>
                          <td><?php echo $row['date_item']; ?></td>
                          <td><?php echo $row['year']; ?></td>
                        </tr>
                      <?php

                    }
                  ?>
                  <?php
          //Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
                    $sql = "SELECT SUM(tb_fix.price_fix), SUM(tb_da.price), COUNT(tb_type.id_type), tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc
                            LEFT JOIN tb_type ON tb_type.id_type=tb_da.id_item
                            LEFT JOIN tb_dep ON tb_dep.id_dep=tb_type.id_type
                            LEFT JOIN tb_cal ON tb_cal.id_type=tb_dep.id_dep
                            LEFT JOIN tb_s ON tb_s.sid= tb_cal.id_type
                            LEFT JOIN tb_fix ON tb_fix.id_fix=tb_s.sid
                            Where tb_fix.status='รอผลจากผู้บริหาร' AND tb_dep.dep_status='ใช้งานปกติ'";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                  <tr class="table-secondary">
                         
                        <td align="center"><b>จำนวน</td>
                        <td align="left"><b><?php echo $row['COUNT(tb_type.id_type)']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>รายการ</b></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="left"><b>รวม&nbsp;&nbsp;</b><b><?php echo number_format($row['SUM(tb_da.price)']); ?></b>&nbsp;&nbsp;<b>บาท</b></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        
                    </tr>
                       <?php
                    }
                  ?>
  </tbody>
</table>
	</div>	
	</body>
</html>