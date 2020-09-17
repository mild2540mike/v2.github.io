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
	<div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>รายการชำรุด</b></div>
	         <!-- link/link -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item "><a href="manage.php">จัดการวัสดุ</a></li>
              <li class="breadcrumb-item "><a href="manage_fix.php">รายการชำรุด</a></li>
              <li class="breadcrumb-item "><a href="manage_use.php">รายการใช้งานปกติ</a></li>
          </div><!-- /.col -->

	  <div align="right">
    <input onclick="javascript:window.print()" type="button"  class="btn btn-info btn-lg " value="พิมพ์" name="print2">
    </div>

	<div class="table">
	<table class="table table-hover table-light">
  <thead class="thead thead-dark">
    <tr>
      <th scope="col" width="1%">ลำดับ</th>
      <th scope="col" width="15%">ชื่อประเภท</th>
      <th scope="col" width="14%">ยี่ห้อ</th>
      <th scope="col" width="10%">สถานะ</th>
      <th scope="col" width="10%">หมายเหตุ</th>

      <th scope="col" width="10%">เลขที่เอกสาร</th>
      <th scope="col" width="10%">รายการเปลี่ยนแปลง</th>
      <th scope="col" width="10%">หลังฐานการจ่ายเงิน</th>

      <th scope="col" width="10%">ราคาต่อหน่วย</th>
      <th scope="col" width="10%">ใช้ประจำ</th>
     

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

                    WHERE tb_fix.fix_status='ชำรุด' ORDER BY sid DESC";
                       
                            //$dep_d = date("Y-m-d");

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                           <tr>
                          <td><?php echo $row['sid']; ?></td>
                          <td><?php echo $row['name_type']; ?></td>
                          <td><?php echo $row['brand']; ?></td>
                          <td><?php echo $row['fix_status']; ?></td>
                          <td><?php echo $row['note']; ?></td>

                          <td><?php echo $row['num_d']; ?></td>
                          <td><?php echo $row['c_list']; ?></td>
                          <td><?php echo $row['Proof_pay']; ?></td>

                          <td><?php echo number_format($row['price']); ?></td>
                          <td><?php echo $row['use_to']; ?></td>
                      

                        </tr>
                      <?php

                    }
                  ?>
                  <?php
          //Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
                    $sql = "SELECT SUM(price), COUNT(id_type) FROM tb_cal WHERE fix_status='ชำรุด'";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                  <tr class="table-secondary">
                         
                         <td align="right"><b>จำนวน</td>
                         <td align="left"><b><?php echo $row['COUNT(id_type)']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>รายการ</b></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="right"><b>ราคา</b></td>
                        <td><b><?php echo number_format($row['SUM(price)']); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>บาท</b></td>
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