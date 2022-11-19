<!DOCTYPE html>
<html>
<head>
	<title>Pengumuman Kelulusan SMAN 1 2x11 Enam Lingkung</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="icon" type="img/jpg" href="img/tetap/icon.jpg">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.countdown.js"></script>
	<style>
		.waktu{
			font-size: 80px; 
			margin: 20px 0; 
			border:2px solid; 
			border-radius: 20px;
			padding: 20px 0;
			background-color: rgba(167,214,167,0.5);
		}
	</style>
</head>
<body style="background-image: url(img/tetap/back.png);">
	<div class="container" style="padding-top: 2%;">
		<div class="panel panel-success">
			<div class="panel-heading">
				<table class="table" style="text-align:center; font-size: 25px; margin: 1px auto;">
					<thead>
					<tr>
						<td><img src="img/tetap/prov.png" width="100"/></td>
						<td style="padding: 0px;">
						<span style="font-size: 24px">PEMERINTAH PROVINSI SUMATERA BARAT</span><br>
						<span style="font-size: 20px;">DINAS PENDIDIKAN</span><br>
						SMAN 1 2x11 ENAM LINGKUNG<br>
						<span style="font-size: 21px;">KABUPATEN PADANG PARIAMAN</span>
						</td>
						<td><img src="img/tetap/pdd.png" width="120"/></td>
					</tr>
					</thead>
				</table>
			</div>
			<div class="panel-body" style="height: 700px;">
				<p align="center" style="font-size: 45px; margin: 50px 0;"><marquee>Pengumuman Kelulusan Dalam Waktu</marquee></p><br>
				<div id="getting-started" class="waktu" align="center" style="padding: 60px 0;"></div>
				<script type="text/javascript">
				  $('#getting-started').countdown('2019-11-01 17:00:00', function(event) {
				    $(this).html(event.strftime('%w Minggu %d Hari %H:%M:%S'));
					  });
				</script>
			</div>
			<div class="panel-footer" align="center">
				&copy 2018 Kali
			</div>
		</div>
	</div>
</body>
</html>