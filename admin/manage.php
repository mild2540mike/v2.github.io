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
  body {
    background-color: #BEBEBE;
    background-size: cover;
  }

  div {
    padding: 5px;
  }

  table {
    font-size: 16px;
  }

  div.table {
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
  <div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>รายการวัสดุ</b></div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-left">
      <li class="breadcrumb-item "><a href="manage.php">จัดการวัสดุ</a></li>
      <li class="breadcrumb-item "><a href="manage_fix.php">รายการชำรุด</a></li>
      <li class="breadcrumb-item "><a href="manage_use.php">รายการใช้งานปกติ</a></li>
  </div><!-- /.col -->
  <div align="right">
    <button onclick="window.location.href='manage_add.php'" type="button" class="btn btn-primary btn-lg"><b>เพิ่มข้อมูลวัสดุ</b></button>
  </div>

  <div class="table">
    <table class="table table-hover table-light">
      <thead class="thead thead-dark">
        <tr>
          <th scope="col">ลำดับ</th>
          <th scope="col" style="text-align: center;" width="12%">ภาพวัสดุ</th>
          <th scope="col">วันเดือนปีที่ส่งของ</th>
          <th scope="col">รหัสหน่วยงานปีที่ซื้อ</th>
          <th scope="col" width='20%'>ชื่อประเภท</th>
          <th scope="col">หมายเหตุ</th>
          <th scope="col">ราคาต่อหน่วย</th>
          <th scope="col">วิธีการได้มา</th>
          <th scope="col">ใช้ประจำที่</th>
          <th scope="col" width='10%'>จัดการ</th>
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
                            ORDER BY sid ASC";

        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {

          if ($row["how_to"] == "ตกลงราคา") {
            $bg = "warning";
          } elseif ($row["how_to"] == "บริจาค") {
            $bg = "success";
          } elseif ($row["how_to"] == "") {
            $bg = "warning";
          } else {
            $bg = "danger";
          }

        ?>







          <tr>

            <td><?php echo $row['sid']; ?></td>
            <td align="center"><img src="../admin/image/<?php echo $row['img_name']; ?>" width="100px" height="100px" onclick="window.location.href='manage_update.php?id_fix=<?php echo $row["sid"]; ?>'"></td>
            <td><?php echo $row['date_item']; ?></td>
            <td><?php echo $row['id_department']; ?></td>
            <td><?php echo $row['name_type'] . '<br>ยี่ห้อ : ' . $row['brand']; ?></td>
            <td><?php echo $row['note']; ?></td>
            <td><?php echo number_format($row['price']); ?></td>

            <td><span class="badge badge-<?php echo $bg; ?> badge-pill"><?php echo $row["how_to"]; ?></span></td>
            <td><?php echo $row['use_to']; ?></td>
            <td>
              <button class="btn btn-success btn-flat" onclick="window.location.href='manage_update.php?id_fix=<?php echo $row["sid"]; ?>'"><i class="fa fa-edit">แก้ไข</i></button>
              <button class="btn btn-danger btn-flat" onclick="window.location.href='manage_delete_process.php?id_type=<?php echo $row["sid"]; ?>'"><i class="fa fa-trash">ลบ</i></button>
            </td>

          </tr>

        <?php
        }
        ?>
        <?php
        //Join ฐานข้อมูล ในตาราง tb_fix กับ tb_type โดยใช้ sid กำหนด
        $sql = "SELECT SUM(price), COUNT(id_type) FROM tb_cal";

        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
        ?>
          <tr class="table-secondary">

            <td align="center"><b>จำนวน</td>
            <td align="left"><b><?php echo $row['COUNT(id_type)']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>รายการ</b></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"><b>รวมทรัพย์สิน</b></td>
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
</body>

</html>