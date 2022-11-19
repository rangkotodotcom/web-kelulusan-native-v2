<?php

session_start();

if(!isset($_SESSION['user'])){
	echo"
			<script>
				alert('Anda Belum Login. Silahkan Login Dahulu!!!');
				document.location.href = '../index.php';
			</script>
		";
}else{

require_once __DIR__ . '/../vendor/autoload.php';
include '../conn.php';
include '../functions.php';

$color = "#FF7F50";

$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE level = 'siswa' ");

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P', 'margin_left' => 25, 'margin_right' =>25]);

$html = '<!DOCTYPE html>
<html>
<head>
	<title>Daftar Username Siswa</title>
</head>
<body>
	<div class="header">
		<center>
			<table style="text-align:center; width:100%; border-bottom:1px solid;">
				<tr>
					<td align="center"><img src="../img/tetap/prov.png" width="70"/></td>
					<td style="font-size:16px;">
					PEMERINTAH PROVINSI SUMATERA BARAT<br>
					<span style="font-size:14px;">DINAS PENDIDIKAN</span><br>
					<span style="font-size:18x;">SMAN 1 2x11 ENAM LINGKUNG</span><br>
					KABUPATEN PADANG PARIAMAN<br>
					</td>
					<td align="center"><img src="../img/tetap/pdd.png" width="80"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:10px; text-align:justify;">Alamat : jl. Bari Sicincin   Telp : 0751-675129   E-mail : smansa2x11el@gmail.com   Website : sman12x11el.sch.id   Kode Pos : 25584 </td>
				</tr>
			</table>
			

		</center>

	</div>

	<div class="content">

		<h3 style="text-align:center;"><u>Daftar Username Siswa</u></h3><br>
		<div style="float:right; -webkit-print-color-adjust: exact;">
		';

			$i=1;
			while($data = mysqli_fetch_assoc($sql)) {
			$html.= '<table style="margin:3px; float:right; border: 1px solid '.$color.';width: 280px; overflow:hidden; position:relative; padding: 0px;">
						<tbody>
							<tr>
								<td style="color:#666;" valign="top">
									<table style="width:100%;">
										<tbody>
											<tr>
												<td style="width:110px">
													<div style="position:relative;z-index:-1;padding: 0px;float:left;">
														<div style="position:absolute; top:0; display:inline; margin-top:-15px; width: 0;  height: 0; border-top: 280px solid transparent; border-left: 40px solid transparent; border-right:180px solid #DCDCDC; "></div>
													</div>
													<img style="margin:2px 0 0 2px;" width="85" src="../img/tetap/logo.png" alt="logo">
												</td>	
												<td style="width:110px">
													<div style="float:right;margin-top:-6px;margin-right:0px;width:5%;text-align:right;font-size:7px;">
													</div>
													<div style="text-align:right;font-weight:bold;font-family:Tahoma;font-size:16px;padding-left:18px;color:'.$color.'">
													<small style="font-size:14px;margin-left:-17px;position:absolute;"></small>Kartu Login ['.$i++.']
													</div>	
												</td>	
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td style="color:#666;border-collapse: collapse;" valign="top">
									<table style="width:100%;border-collapse: collapse;">
										<tbody>
											<tr>
												<td style="width:110px"valign="top" >
													<div style="clear:both;color:#555;margin-top:2px;margin-bottom:2.5px;">
													<div style="padding:0px;border-bottom:1px solid '.$color.';text-align:center;font-weight:bold;font-size:18px;">'.$data["nama"].'</div>
													<div style="padding:0px;border-bottom:1px solid '.$color.';text-align:justify;font-weight:bold;font-size:16px;;color:#000000;">User : '.$data["user"].'</div>
													<div style="padding:0px;border-bottom:1px solid '.$color.';text-align:justify;font-weight:bold;font-size:16px;;color:#000000;">Pass : '.$data["pass"].'</div>
													</div>
												</td>	
											<td style="width:110px;text-align:right;">
											<div style="float:right;padding:1px;text-align:right;width:100%;margin:0 0px -5px 0;"></div>
											</td>		
											</tr>
											<tr>
												<td style="background:'.$color.';color:#666;padding:0px;" valign="top" colspan="2">
													<div style="text-align:left;color:#fff;font-size:10px;font-weight:bold;margin:0px;padding:2.5px;">
													<b>https://pengumuman.sman12x11el.sch.id</b>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>';
			}

		$html.= '</div>
	</div>
	<div class="footer">
		<table style="text-align:center; width:100%; ">
			<tr>
				<td align="left" style="padding-left:370px;">';
				$html.= 
					'<p>Sicincin, '. tanggal(date('j F Y')) .'<br>
					Kepala Sekolah</p><br><br><br><br><br>
					<p><b>SRI ASTUTI, S.Pd, M.M.</b><br>NIP. 19620414 198703 2 008</p>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('Daftar Username Siswa.pdf', 'I');

mysqli_query($conn, "INSERT INTO t_history VALUES('', 'cetak user', '$_SESSION[user]', NULL) ");

}

?>