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
  <div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>รายการใช้งานปกติ</b></div>
  <!-- link/link -->
  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item "><a href="dep.php">จัดการค่าเสื่อม</a></li>
              <li class="breadcrumb-item "><a href="dep_sell.php">รายการจำหน่าย</a></li>
              <li class="breadcrumb-item "><a href="dep_use.php">รายการใช้งานปกติ</a></li>
          </div><!-- /.col -->
  
    <div align="right">
    <input onclick="javascript:window.print()" type="button"  class="btn btn-info btn-lg " value="พิมพ์" name="print3">
    </div>

  <div class="table">
  <table class="table table-hover table-light">
  <thead class="thead thead-dark">
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อประเภท</th>
      <th scope="col">ยี่ห้อ</th>
      <th scope="col">วันเดือนปีที่ส่งของ</th>
      <th style="text-align: center;" scope="col">อายุ(ปี : ปัจจุบัน)</th>
      <th scope="col">ราคาต่อหน่วย</th>
      <th scope="col">สถานะ</th>
      <th scope="col" style="text-align: center;" width="14%">มูลค่าคงเหลือ</th>
      
    </tr>
  </thead>
  <tbody>

    <?php
                    $sql = "SELECT *, tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc
                            LEFT JOIN tb_type ON tb_type.id_type=tb_da.id_item
                            LEFT JOIN tb_dep ON tb_dep.id_dep=tb_type.id_type
                             LEFT JOIN tb_cal ON tb_cal.id_type=tb_dep.id_dep
                            WHERE tb_dep.dep_status ='ใช้งานปกติ'";
                       
                            //$dep_d = date("Y-m-d");

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                           <tr>
                          <td><?php echo $row['sid']; ?></td>
                          <td><?php echo $row['name_type']; ?></td>
                          <td><?php echo $row['brand']; ?></td>
                          <td><?php echo $row['date_item']; ?></td>
                          <td align="center"><?php echo $row['dep_now']; ?></td>
                          <td ><?php echo number_format($row['price']); ?></td>
                          <td><?php echo $row['dep_status']; ?></td>
                          <td style="text-align: center;"><?php echo number_format($row['dep_del']); ?></td>
                         
                        </tr>
                      <?php

                    }
                  ?>
                  <?php
          //Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
                    $sql = "SELECT SUM(tb_cal.dep_del), SUM(tb_da.price), COUNT(tb_type.id_type), tb_doc.id_doc AS sid FROM tb_doc 
                            LEFT JOIN tb_da ON tb_da.id_item=tb_doc.id_doc
                            LEFT JOIN tb_type ON tb_type.id_type=tb_da.id_item
                            LEFT JOIN tb_dep ON tb_dep.id_dep=tb_type.id_type
                             LEFT JOIN tb_cal ON tb_cal.id_type=tb_dep.id_dep
                            WHERE tb_dep.dep_status ='ใช้งานปกติ'";

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
                        <td align="center"><b>รวม&nbsp;&nbsp;</b><b><?php echo number_format($row['SUM(tb_cal.dep_del)']); ?></b>&nbsp;&nbsp;<b>บาท</b></td>
                        
                       
                        
                    </tr>
                       <?php
                    }
                  ?>
  </tbody>
</table>
  </div>  
  </body>
</html>