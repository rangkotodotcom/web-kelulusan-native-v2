<?php 

$kd = base64_decode(@$_GET['user']);

$sql = mysqli_query($conn, "SELECT * FROM t_ln_siswa WHERE no_pes = '$kd' ");
$data = mysqli_fetch_assoc($sql);

 ?>

<fieldset>

	
	<button onclick="lihat()" class="btn btn-info btn-lg" style="margin-top: 50px;" >
		<span class="glyphicon glyphicon-hand-down"></span> Lihat Hasil
	</button>
	<div id="hasil"></div>

	<script>

		function lihat() {
			document.getElementById("hasil").innerHTML = "<div style='margin:50px 0; padding:20px 0; font-size:20px; border:2px solid; background-color:#faebd7; border-radius:20px;'><h1 align='center'>Anda Dinyatakan <span style='color:#b22222; font-size:60px;'><?= $data['ket']; ?></span> Dari Sekolah Menengah Atas Negeri 1 2x11 Enam Lingkung.<br> Silahkan Cek Data Diri Anda Pada Menu Data Diri di Samping.<br> Silahkan Cetak Surat Keterangan Kelulusan Pada Menu Nilai UN di Samping.</h1></div>";
		}
	</script>

</fieldset>