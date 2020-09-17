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
	<div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>ค่าเสื่อมวัสดุ</b></div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item "><a href="dep.php">จัดการค่าเสื่อม</a></li>
              <li class="breadcrumb-item "><a href="dep_sell.php">รายการจำหน่าย</a></li>
              <li class="breadcrumb-item "><a href="dep_use.php">รายการใช้งานปกติ</a></li>
          </div><!-- /.col -->
	
	<div class="table">
	<table class="table table-hover table-light">
  <thead class="thead thead-dark">
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อประเภท</th>
      <th scope="col">ยี่ห้อ ขนาด</th>
      <th scope="col">วันเดือนปีที่ส่งของ</th>
      <th scope="col">อายุ(ปี : ปัจจุบัน)</th>
      <th scope="col">ราคาต่อหน่วย</th>
      <th scope="col">ค่าเสื่อมสะสม</th>
      <th scope="col">มูลค่าคงเหลือ</th>
      <th width="100px" scope="col">สถานะ</th>
      <th width="100px" scope="col">จัดการ</th>
      
    </tr>
  </thead>
  <tbody>

    <?php
                    $sql = "SELECT tb_type.id_type AS sid, tb_type.name_type, tb_type.brand, tb_doc.date_item, ROUND((datediff(curdate(),tb_doc.date_item) /365),0) AS 'dep_now' ,tb_da.price, tb_dep.dep_age, ROUND((tb_da.price / tb_dep.dep_age) * (datediff(curdate(),tb_doc.date_item) /365),0) AS 'dep_y', ROUND(tb_da.price - ((tb_da.price / tb_dep.dep_age) * (datediff(curdate(),tb_doc.date_item) /365)),0) AS 'dep_del', dep_status FROM tb_type, tb_doc, tb_da, tb_dep
                      WHERE tb_type.id_type = tb_doc.id_doc AND tb_type.id_type = tb_da.id_item AND tb_type.id_type = tb_dep.id_dep
                      ORDER BY `sid`  DESC";
                       
                            //$dep_d = date("Y-m-d");

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                      if ($row["dep_status"] == "ใช้งานปกติ") {
                        $bg = "success";
                      } elseif ($row["dep_status"] == "จำหน่าย") {
                        $bg = "danger";
                      } elseif ($row["dep_status"] == "") {
                        $bg = "warning";
                      } else {
                        $bg = "";
                      }

                    
            
                      ?>
                        <tr>
                           <tr>
                          <td><?php echo $row['sid']; ?></td>
                          <td><?php echo $row['name_type']; ?></td>
                          <td><?php echo $row['brand']; ?></td>
                          <td><?php echo $row['date_item']; ?></td>
                          <td align="center"><?php echo $row['dep_now']; ?></td>
                          <td align='center'><?php echo number_format($row['price']); ?></td>
                          <td align='center'><?php echo number_format($row['dep_y']); ?></td>
                          <td align='center'><?php echo number_format($row['dep_del']); ?></td>
                          <td><span class="badge badge-<?php echo $bg; ?> badge-pill"><?php echo $row["dep_status"]; ?></span></td>
                          <td>
                            <button class="btn w3-blue btn-flat" onclick="window.location.href='dep_update.php?id_dep=<?php echo $row["sid"]; ?>'"><i class="fa fa-edit"></i> เพิ่ม</button>
                          </td>
                        </tr>
                      <?php

                    }
                  ?>
                   <?php
          //Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
                    $sql = "SELECT SUM(dep_y) FROM tb_cal";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                  <tr class="table-secondary">
                         
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="right"><b>รวมมูลค่าสุทธิ</b></td>
                        <td><b><?php echo number_format($row['SUM(dep_y)']); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>บาท</b></td>
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