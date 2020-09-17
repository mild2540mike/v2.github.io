      <div align="right">
      <input onclick="javascript:window.print()" type="button"  class="btn btn-info btn-lg" value="พิมพ์" name="print18"></div>
      <div>
        <?php
include('include/conn.php');

$sql = "SELECT * FROM `tb_use`
       WHERE year like '%".$_POST['search']."%'";


echo '<table class="table table-hover table-light">';
echo '<thead class="thead thead-dark">
    <tr>
     <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อประเภท</th>
      <th scope="col">ยี่ห้อ</th>
      <th scope="col">วันเดือนปีที่ส่งของ</th>
      <th scope="col">ราคาต่อหน่วย</th>
      <th scope="col">อายุ(ปี : ปัจจุบัน)</th>
      <th scope="col">ราคาซ่อม</th>
      <th scope="col">มูลค่าคงเหลือ</th>
      <th scope="col">ปีจำหน่าย</th>
    </tr>
  </thead>';

			
$query = $conn->query($sql);
while($row = $query->fetch_assoc()){
	echo '<tr><td>'.$row["sid"].'</td>';
  echo '<td>'.$row["name_type"].'</td>';
  echo '<td>'.$row["brand"].'</td>';
  echo '<td>'.$row["date_item"].'</td>';
  echo '<td>'.number_format($row["price"]).'</td>';
  echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row["dep_now"].'</td>';
  echo '<td>'.number_format($row["price"]).'</td>';
  echo '<td>'.number_format($row["dep_del"]).'</td>';
  echo '<td>'.$row["year"].'</td>';


	echo '</tr>';
}
echo '</table>';
mysqli_close($conn);
?>