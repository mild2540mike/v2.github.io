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
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    </head>
    <style>
        body{
            background-color:teal;
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
    <div class="p-3 mb-2 bg-dark text-white border-top" style="text-align: center;font-size: 25px;"><b>รายการประเมิน</b>
    </div>
    <?php
      include('include/navbar.php'); 
      ?>
    <div class="table">
    <table class="table table-hover table-light">
  <thead class="thead thead-dark">
    <tr>

      <th scope="col">ภาพวัสดุ</th>
      <th scope="col">ชื่อประเภท</th>
      <th scope="col">การประเมิน</th>
      <th scope="col">ราคาต่อหน่วย</th>
      <th scope="col">มูลค่าคงเหลือ</th>
      <th scope="col">ราคาซ่อม</th>
      <th scope="col">วิธีการได้มา</th>
      <th scope="col">จำหน่ายปี</th>
      <th scope="col"></th>
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
                    
                    Where tb_fix.fix_status='ชำรุด' AND NOT tb_fix.status='รอผลจากผู้บริหาร' AND tb_dep.dep_status='ใช้งานปกติ' ORDER BY sid DESC";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>

                          <td><a onclick="window.location.href='ceo_update.php?id_fix=<?php echo $row["sid"];?>'"><img src="../admin/image/<?php echo $row['img_name']; ?>" width="100px" height="100px"></a></td>
                          <td><?php echo $row['name_type'].'<br>ยี่ห้อ : '. $row['brand']; ?></td>
                          <td><?php echo $row['status']; ?></td>
                          <td><?php echo number_format($row['price']); ?></td>
                          <td><?php echo number_format($row['dep_del']); ?></td>
                          <td><?php echo number_format($row['price_fix']); ?></td>
                          <td><?php echo $row['how_to']; ?></td>
                          <td><?php echo $row['year']; ?></td>
                          <td align="center"><button class="btn btn-danger active btn-flat" 
                              onclick="window.location.href='ceo_update.php?id_fix=<?php echo $row["sid"];?>'"><i class="fa fa-eye"> รายละเอียด</i></button>
                              </td>
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
                            Where tb_fix.fix_status='ชำรุด' AND NOT tb_fix.status='รอผลจากผู้บริหาร' AND tb_dep.dep_status='ใช้งานปกติ'";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                  <tr class="table-secondary">
                         
                        <td align="center"><b>จำนวน</td>
                        <td align="left"><b><?php echo $row['COUNT(tb_type.id_type)']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>รายการ</b></td>
                        <td align="center"></td>
                        <td align="left"><b>รวม&nbsp;&nbsp;</b><b><?php echo number_format($row['SUM(tb_da.price)']); ?></b>&nbsp;&nbsp;<b>บาท</b></td>
                        <td align="center"></td>
                        <td align="left"><b>รวม&nbsp;&nbsp;</b><b><?php echo number_format($row['SUM(tb_fix.price_fix)']); ?></b>&nbsp;&nbsp;<b>บาท</b></td> 
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
    </body>
</html>