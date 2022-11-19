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

$kd = base64_decode(@$_GET['no_pes']);
$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa WHERE no_pes = '$kd' ");
$sql1 = mysqli_query($conn, "SELECT * FROM t_ln_siswa WHERE no_pes = '$kd' ");
$sql2 = mysqli_query($conn, "SELECT * FROM t_n_sekolah WHERE no_pes = '$kd' ");
$sql3 = mysqli_query($conn, "SELECT * FROM t_n_sekolah WHERE no_pes = '$kd' ");
$data = mysqli_fetch_assoc($sql);
$data1 = mysqli_fetch_assoc($sql1);
$data2 = mysqli_fetch_assoc($sql2);
$data3 = mysqli_fetch_assoc($sql3);

if($data['jurusan'] == 'A'){
	$program = 'ILMU PENGETAHUAN ALAM';
}else{
	$program = 'ILMU PENGETAHUAN SOSIAL';
}

$bin = $data1['bin'];
$bing = $data1['bing'];
$mat = $data1['mat'];
$pil = $data1['pil'];
$ket = $data1['ket'];
$mapel_pil = $data1['mapel_pil'];

$total_un = $bin + $bing + $mat + $pil ;
$rata_rata_un = $total_un/ 4 ;

$pai_r = $data2['pai'];
$ppkn_r = $data2['ppkn'];
$ind_r = $data2['ind'];
$mtk_r = $data2['mtk'];
$sejind_r = $data2['sejind'];
$ing_r = $data2['ing'];
$senbud_r = $data2['senbud'];
$pjok_r = $data2['pjok'];
$pkwu_r = $data2['pkwu'];
$mat_sej_r = $data2['mat_sej'];
$fis_eko_r = $data2['fis_eko'];
$kim_sos_r = $data2['kim_sos'];
$bio_geo_r = $data2['bio_geo'];
$lm_r = $data2['lm'];

$total_r = $pai_r + $ppkn_r + $ind_r + $mtk_r + $sejind_r + $ing_r + $senbud_r + $pjok_r + $pkwu_r + $mat_sej_r + $fis_eko_r + $kim_sos_r + $bio_geo_r + $lm_r ;

$rata_rata_r = $total_r/14;

$pai_us = $data3['pai'];
$ppkn_us = $data3['ppkn'];
$ind_us = $data3['ind'];
$mtk_us = $data3['mtk'];
$sejind_us = $data3['sejind'];
$ing_us = $data3['ing'];
$senbud_us = $data3['senbud'];
$pjok_us = $data3['pjok'];
$pkwu_us = $data3['pkwu'];
$mat_sej_us = $data3['mat_sej'];
$fis_eko_us = $data3['fis_eko'];
$kim_sos_us = $data3['kim_sos'];
$bio_geo_us = $data3['bio_geo'];
$lm_us = $data3['lm'];

$total_us = $pai_us + $ppkn_us + $ind_us + $mtk_us + $sejind_us + $ing_us + $senbud_us + $pjok_us + $pkwu_us + $mat_sej_us + $fis_eko_us + $kim_sos_us + $bio_geo_us + $lm_us ;

$rata_rata_us = $total_us/14;


$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P', 'margin_left' => 25, 'margin_right' =>25]);

$mpdf->SetWatermarkImage('../img/tetap/pdd.png');
$mpdf->showWatermarkImage = true;
$mpdf->watermarkImageAlpha = 0.2;


$html = '<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Lulus</title>
</head>
<body>
	<div class="header">
		<center>
			<table style="text-align:center; width:100%; border-bottom:3px solid;">
				<tr>
					<td align="center"><img src="../img/tetap/prov.png" width="70"/></td>
					<td style="font-size:16px;">
					PEMERINTAH PROVINSI SUMATERA BARAT<br>
					<span style="font-size:14px;">DINAS PENDIDIKAN</span><br>
					<span style="font-size:18x;">SMAN 1 2x11 ENAM LINGKUNG</span><br>
					KABUPATEN PADANG PARIAMAN<br>
					</td>
					<td align="center"><img src="../img/tetap/logo.png" width="80"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:10px; text-align:justify;">Alamat : jl. Bari Sicincin   Telp : 0751-675129   E-mail : smansa2x11el@gmail.com   Website : sman12x11el.sch.id   Kode Pos : 25584 </td>
				</tr>
			</table>
			

		</center>

	</div><br>

	<div class="content">
		<h3 align="center"><u><b>SURAT KETERANGAN LULUS</b></u><br><span style="font-size:12px;">NOMOR : 421/478/SMAN.1-2x11 EL/2019</span></h3>
		<p style="font-size:14px;">Yang bertanda tangan dibawah ini, Kepala Sekolah Menengah Atas Negeri 1 2x11 Enam Lingkung Kabupaten Padang Pariaman:</p>
			<table style="font-size:14px;" cellpadding="1">
				<tr>
					<td>Nomor Pokok Sekolah Nasional</td>
					<td> : </td>
					<td>10305549</td>
				</tr>
				<tr>
					<td>Kabupaten/<s>Kota</s></td>
					<td> : </td>
					<td>Padang Pariaman</td>
				</tr>
				<tr>
					<td>Provinsi</td>
					<td> : </td>
					<td>Sumatera Barat</td>
				</tr>
				<tr>
					<td>      </td>
				</tr>
				<tr>
					<td>      </td>
				</tr>
				<tr>
					<td colspan="3">Menerangkan Bahwa</td>
				</tr>
				<tr>
					<td>      </td>
				</tr>
				<tr>
					<td>      </td>
				</tr>
				<tr>
					<td>Nama</td>
					<td> : </td>';
					$html .=' 
					<td>'. $data["nama"] .'</td>
				</tr>
				<tr>
					<td>Tempat dan Tanggal Lahir</td>
					<td> : </td>';
					$html .=' 
					<td>'. $data["t_lahir"] .','.'  '. tanggal(date("j F Y", strtotime($data['tgl_lhr']))) .'</td>
				</tr>
				<tr>
					<td>Nama Orang Tua/Wali</td>
					<td> : </td>';
					$html .=' 
					<td>'. $data["n_ortu"] .'</td>
				</tr>
				<tr>
					<td>Nomor Induk Siswa</td>
					<td> : </td>';
					$html .=' 
					<td>'. $data["nis"] .'</td>
				</tr>
				<tr>
					<td>Nomor Induk Siswa Nasional</td>
					<td> : </td>';
					$html .=' 
					<td>'. $data["nisn"] .'</td>
				</tr>
				<tr>
					<td>Nomor Peserta Ujian</td>
					<td> : </td>';
					$html .=' 
					<td>'. $data["no_pes"] .'</td>
				</tr>
				<tr>
					<td>Sekolah Penyelenggara Ujian Sekolah</td>
					<td> : </td>
					<td>SMAN 1 2x11 Enam Lingkung</td>
				</tr>
				<tr>
					<td>Sekolah Penyelenggara Ujian Nasional</td>
					<td> : </td>
					<td>SMAN 1 2x11 Enam Lingkung</td>
				</tr>
				<tr>
					<td>      </td>
				</tr>

			</table>

			<p style="font-size:13px;" align="justify">Berdasarkan hasil keputusan Rapat Dewan Guru tanggal 13 Mei 2019, nama yang tersebut diatas dinyatakan ;</p>
			<p align="center" style="font-size:25px;">'; $html .='<b>" '. $ket .' "</b></p>
			<p style="font-size:13px;" align="justify">Dari Sekolah Menengah Atas setelah memenuhi seluruh kriteria sesuai dengan peraturan perundang-undangan.<br><br>
			Surat Keterangan ini berlaku sampai keluarnya ijazah/STTB di terbitkan.<br><br>
			Demikian Surat Keterangan ini diberikan agar di pergunakan sebagaimana mestinya.</p><br><br><br>
	</div>

	<div class="footer">
		<table style="text-align:center; width:100%; ">
			<tr>';
			$html .=' 
				<td align="right" style="padding-left:260px;">
					<img src="../img/siswa/'. $data["foto"] .'" width="100" />
				</td>
				<td align="left" style="padding-left:20px;">
					<p>Sicincin, 13 Mei 2019<br>Kepala Sekolah,</p><br><br><br><br>
					<p><b><u>Drs. ENDRIZAL, M.Pd.E</u></b><br>NIP. 19661212 199803 1 004<br><span style="font-size:8px;"><i>Skj Nomor : 803/314/SMAN.1 2x11-EL/ 2019 <br>Tanggal : 18 Maret 2019<i></span></p>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
';

$mpdf->WriteHTML($html);

$mpdf->SetHTMLFooter('
<table width="100%" style="border-top:1px solid; font-size:10px;">
    <tr>
        <td width="37%"><i>'. $data["nama"] .'</i></td>
        <td width="27%" align="center">SMAN 1 2x11 ENAM LINGKUNG</td>
        <td width="37%" align="right"><i>'. $data["nisn"] .'</i></td>
        
    </tr>
</table>');

$mpdf->AddPage();

$html1 = '<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Lulus</title>
</head>
<body>
	<div class="header">
		<center>
			<table style="text-align:center; width:100%;">
				<tr>
					<td style="font-size:15px;">
					DAFTAR NILAI<br>
					SMAN 1 2x11 ENAM LINGKUNG<br>
					PROGRAM '.$program.'<br>
					TAHUN PELAJARAN 2018/2019<br>
					</td>
				</tr>
			</table><br>
			<table width="90%" style="font-size:13px;">
				<tr>
					<td>Nama</td>
					<td> : </td>';
					$html1 .=' 
					<td><b>'. $data["nama"] .'</b></td>
				</tr>
				<tr>
					<td>Tempat dan Tanggal Lahir</td>
					<td> : </td>';
					$html1 .=' 
					<td>'. $data["t_lahir"] .','.'  '. tanggal(date("j F Y", strtotime($data['tgl_lhr']))) .'</td>
				</tr>
				<tr>
					<td>NIS / NISN</td>
					<td> : </td>';
					$html1 .=' 
					<td>'. $data["nis"] .' / '. $data["nisn"] .'</td>
				</tr>
				<tr>
					<td>Mata Ujian Pilihan</td>
					<td> : </td>';
					$html1 .=' 
					<td>'. $mapel_pil .'</td>
				</tr>
			</table>
		</center>

	</div><br>

	<div class="content">
			<p align="justify" style="margin:0; font-size:14px;">A. Capaian Rata-Rata Nilai Rapor dan Nilai Ujian sekolah (USBN-BK & KP) Sebagai Berikut :</p>

			<table width="100%" cellspacing="0" cellpadding="1" border="1" style="text-align:center; border:2px solid;">
				<tr style="background-color:#d3d3d3">
					<th rowspan="2" style="text-align: center; line-height: 50px;">No</th>
					<th rowspan="2" style="text-align: center; line-height: 50px;">Mata Pelajaran</th>
					<th colspan="2" style="text-align: center;">Nilai</th>
				</tr>
				<tr style="background-color:#d3d3d3">
					<th rowspan="2" style="text-align: center;">Rata-Rata Rapor</th>
					<th rowspan="2" style="text-align: center;">USBN BK/KP</th>
				</tr>
				<tr style="background-color:#d3d3d3">
					<td colspan="2" style="font-weight:bold;" align="left">Kelompok A (Umum)</td>
				</tr>
				<tr>
					<td>1</td>
					<td align="left">Pendidikan Agama dan Budi Pekerti</td>
					<td>'. $pai_r .'</td>
					<td>'. $pai_us .'</td>
				</tr>
				<tr>
					<td>2</td>
					<td align="left">Pendidikan Pancasila dan Kewarganegaraan</td>
					<td>'. $ppkn_r .'</td>
					<td>'. $ppkn_us .'</td>
				</tr>
				<tr>
					<td>3</td>
					<td align="left">Bahasa Indonesia</td>
					<td>'. $ind_r .'</td>
					<td>'. $ind_us .'</td>
				</tr>
				<tr>
					<td>4</td>
					<td align="left">Matematika</td>
					<td>'. $mtk_r .'</td>
					<td>'. $mtk_us .'</td>
				</tr>
				<tr>
					<td>5</td>
					<td align="left">Sejarah Indonesia</td>
					<td>'. $sejind_r .'</td>
					<td>'. $sejind_us .'</td>
				</tr>
				<tr>
					<td>6</td>
					<td align="left">Bahasa Inggris</td>
					<td>'. $ing_r .'</td>
					<td>'. $ing_us .'</td>
				</tr>
				<tr style="background-color:#d3d3d3">
					<td colspan="2" style="font-weight:bold;" align="left">Kelompok B (Umum)</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>1</td>
					<td align="left">Seni Budaya</td>
					<td>'. $senbud_r .'</td>
					<td>'. $senbud_us .'</td>
				</tr>
				<tr>
					<td>2</td>
					<td align="left">Pendidikan Jasmani, Olahraga dan Kesehatan</td>
					<td>'. $pjok_r .'</td>
					<td>'. $pjok_us .'</td>
				</tr>
				<tr>
					<td>3</td>
					<td align="left">Prakarya dan Kewirausahaan</td>
					<td>'. $pkwu_r .'</td>
					<td>'. $pkwu_us .'</td>
				</tr>
				<tr style="background-color:#d3d3d3">
					<td colspan="2" style="font-weight:bold;" align="left">Kelompok C (Peminatan)</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>1</td>
					<td align="left">Matematika / Sejarah</td>
					<td>'. $mat_sej_r .'</td>
					<td>'. $mat_sej_us .'</td>
				</tr>
				<tr>
					<td>2</td>
					<td align="left">Fisika / Ekonomi</td>
					<td>'. $fis_eko_r .'</td>
					<td>'. $fis_eko_us .'</td>
				</tr>
				<tr>
					<td>3</td>
					<td align="left">Kimia / Sosiologi</td>
					<td>'. $kim_sos_r .'</td>
					<td>'. $kim_sos_us .'</td>
				</tr>
				<tr>
					<td>4</td>
					<td align="left">Biologi / Geografi</td>
					<td>'. $bio_geo_r .'</td>
					<td>'. $bio_geo_us .'</td>
				</tr>
				<tr>
					<td>5</td>
					<td align="left">Lintas Minat</td>
					<td>'. $lm_r .'</td>
					<td>'. $lm_us .'</td>
				</tr>
				<tr style="background-color:#d3d3d3; font-weight:bold;">
					<td colspan="2" style="font-weight:bold;">RATA - RATA</td>
					<td>'. $rata_rata_r .'</td>
					<td>'. $rata_rata_r .'</td>
				</tr>
			</table>

			<p align="justify" style="margin:0">B. Capaian Hasil Ujian Nasional Berbasis Komputer (UNBK) Sebagai Berikut :</p>

			<table width="100%" cellspacing="0" cellpadding="1" border="1" style="text-align:center; border:2px solid;">
				<tr style="background-color:#d3d3d3">
					<th style="text-align: center;">No</th>
					<th style="text-align: center;">Mata Pelajaran</th>
					<th style="text-align: center;">Nilai UNBK</th>
					<th style="text-align: center;">Jumlah</th>
				</tr>
				<tr>
					<td>1</td>
					<td align="left">B Indonesia</td>
					<td>'. $bin .'</td>
					<td rowspan="4" style="line-height:50px;">'. $total_un .'</td>
				</tr>
				<tr>
					<td>2</td>
					<td align="left">B Inggris</td>
					<td>'. $bing .'</td>
				</tr>
				<tr>
					<td>3</td>
					<td align="left">Matematika</td>
					<td>'. $mat .'</td>
				</tr>
				<tr>
					<td>4</td>
					<td align="left">Mata Pelajaran Pilihan</td>
					<td>'. $pil .'</td>
				</tr>
			</table>

	</div><br>

	<div class="footer">
		<table style="text-align:center; width:100%; ">
			<tr>';
			$html1 .=' 
				<td align="right" style="padding-left:260px;">
					<img src="../img/siswa/'. $data["foto"] .'" width="100" />
				</td>
				<td align="left" style="padding-left:20px;">
					<p>Sicincin, 13 Mei 2019<br>Kepala Sekolah,</p><br><br><br><br>
					<p><b><u>Drs. ENDRIZAL, M.Pd.E</u></b><br>NIP. 19661212 199803 1 004<br><span style="font-size:8px;"><i>Skj Nomor : 803/314/SMAN.1 2x11-EL/ 2019 <br>Tanggal : 18 Maret 2019<i></span></p>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
';

$mpdf->WriteHTML($html1);

$mpdf->SetHTMLFooter('
<table width="100%" style="border-top:1px solid; font-size:10px;">
    <tr>
        <td width="37%"><i>'. $data["nama"] .'</i></td>
        <td width="27%" align="center">SMAN 1 2x11 ENAM LINGKUNG</td>
        <td width="37%" align="right"><i>'. $data["nisn"] .'</i></td>
        
    </tr>
</table>');

$mpdf->Output('Surat Keterangan Lulus_'.$data["nama"].'.pdf', 'I');

mysqli_query($conn, "INSERT INTO t_history VALUES('', 'cetak skl', '$_SESSION[user]', NULL) ");

}

?>