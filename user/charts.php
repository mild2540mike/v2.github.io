<?php
	//ตั้งค่าการเชื่อมต่อฐานข้อมูล
	$database_host 			= 'localhost';
	$database_username 		= 'root';
	$database_password 		= '';
	$database_name 			= 'login_db';

	$mysqli = new mysqli($database_host, $database_username, $database_password, $database_name);
//กำหนด charset ให้เป็น utf8 เพื่อรองรับภาษาไทย
	$mysqli->set_charset("utf8");

//กรณีมี Error เกิดขึ้น
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
		//เรียกข้อมูลจาก ตาราง dht 

		$get_data = $mysqli->query("SELECT * FROM `tb_s` WHERE dep_status='ใช้งานปกติ'");
		
		while($data = $get_data->fetch_assoc()){
			
			$result[] = $data;
		}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icons/56.ico"/>
    <title>GRAGE</title>
<link rel="stylesheet" type="text/css" href="css/main3.css">
    <!-- Bootstrap -->
   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  </head>
  <body>
    
		
		
		<div id="kok2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div style=" width:820px; height:425px; overflow: auto;">
		<table class="table" id="datatable" align='center'>
			<thead>
				<tr>
					<th>วันที่หมดอายุ</th>
					<th>มูลค่าคงเหลือ</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($result as $result_tb){
						echo"<tr>";
						echo "<td>".$result_tb['year']. "." ."</td>";
							echo "<td>".$result_tb['dep_del']."</td>";
							
							
						echo"</tr>";
					}
				?>
			
			</tbody>
		</table>

		
	<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	
	<script>
	
	
	$(function () {
				
		$('#kok2').highcharts({
			data: {
				//กำหนดให้ ตรงกับ id ของ table ที่จะแสดงข้อมูล
				table: 'datatable'
			},
			chart: {
				type: 'pie'
			},
			title: {
				text: 'คาดการวัสดุที่จะจำหน่าย'
			},
			subtitle: {
        text: 'ราคาทุน/มูลค่าคงเหลือ'
    },
			  xAxis: {

      
        
    },
    
			yAxis: {
				allowDecimals: false,
				title: {
					text: 'ราคาทุน/มูลค่าคงเหลือ'
				}
			},
			 plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }

    },

			
			tooltip: {
				formatter: function () {
					return '<b>' + this.series.name + '</b><br/>' +
						this.point.y; + ' ' + this.point.name.toLowerCase();
				}
			}
		});
	});
	</script>
	
  </body>
</html>






</div>