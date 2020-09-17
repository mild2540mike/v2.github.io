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
    
	</style>
	<body>
	<div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>รายงานการซ่อม</b></div>
	<div align="right">
    <input onclick="javascript:window.print()" type="button"  class="btn btn-info btn-lg " value="พิมพ์" name="print14">
    </div>
	<div class="table">
	<table class="table table-hover table-light">
  <thead class="thead thead-dark" >
    <tr>
      <th width="180px" scope="col">ชื่อ-สกุลผู้แจ้ง</th>
      <th width="10%" scope="col">ใช้ประจำที่</th>
      <th scope="col">วันที่แจ้งซ่อม</th>
      <th width="14%" scope="col">ประเภทครุภัณฑ์</th>
      <th scope="col">ยี่ห้อ</th>
      <th scope="col">อาการเสีย</th>
      <th scope="col">การประเมิน</th>
      <th width="90px" scope="col">ค่าซ่อม</th>
      <th scope="col">วิธีการได้มา</th>

    </tr>
  </thead>
  <tbody>
    <?php
                    $sql = "SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc 
                            LEFT JOIN tb_bill ON tb_bill.id_bill=tb_da.id_item 
                            LEFT JOIN tb_type ON tb_type.id_type=tb_bill.id_bill 
                            LEFT JOIN tb_fix ON tb_fix.id_fix=tb_type.id_type
                            Where tb_fix.fix_status='ชำรุด' ORDER BY sid DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                         <tr>
                          <td><?php echo $row['dname']; ?></td>
                          <td><?php echo $row['use_to']; ?></td>
                          <td><?php echo $row['date_fix']; ?></td>
                          <td><?php echo $row['name_type']; ?></td>
                          <td><?php echo $row['brand']; ?></td>
                          <td><?php echo $row['break_d']; ?></td>
                          <td><?php echo $row['status']; ?></td>
                          <td><?php echo number_format($row['price_fix']); ?></td>
                          <td><?php echo $row['how_to']; ?></td>

                        </tr>
                      <?php
                    }
                  ?>

                   <?php
          //Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
                    $sql = "SELECT SUM(price_fix), COUNT(id_fix) FROM tb_fix
                            WHERE fix_status = 'ชำรุด'";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                  <tr class="table-secondary">
                         
                         <td align="center"><b>จำนวน</b></td>
                         <td align="center"><b><?php echo $row['COUNT(id_fix)']; ?></b></td>
                         <td align="left"><b>รายการ</b></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="center"></td>
                         <td align="left"><b>รวมราคา</b></td>
                        <td><b><?php echo number_format($row['SUM(price_fix)']); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>บาท</b></td>
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