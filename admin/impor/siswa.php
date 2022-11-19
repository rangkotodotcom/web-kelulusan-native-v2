<fieldset>
	<legend>Import Data Siswa</legend>

	<script src="js/jquery.min.js"></script>
		
	<script>
	$(document).ready(function(){

		$("#nol").hide();
	});
	</script>


	<form action="" method="post" enctype="multipart/form-data">
		<a href="admin/impor/format_import_data_siswa.xlsx" class="btn btn-default pull-left">
			<span class="glyphicon glyphicon-download-alt"></span>
			Download Format
		</a><br><br><br>

		<input type="file" name="file" class="pull-left" required>

		<button type="submit" name="preview" class="btn btn-success btn-sm">
			<span class="glyphicon glyphicon-eye-open"></span> Preview
		</button> 

		<a href="?page=<?= base64_encode("d_siswa"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal </a>

	</form>

	<?php 

	if(isset($_POST['preview'])){
		$nama_file_baru = 'data_siswa.xlsx';

		if(is_file('admin/impor/tmp/'.$nama_file_baru))
			unlink('admin/impor/tmp/'.$nama_file_baru);

		$tipe_file = $_FILES['file']['type'];
		$tmp_file = $_FILES['file']['tmp_name'];

		if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
			move_uploaded_file($tmp_file, 'admin/impor/tmp/'.$nama_file_baru);

			require_once 'PHPExcel/PHPExcel.php';

			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('admin/impor/tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

			echo "<br>";

			echo "<form method='post' action='admin/impor/impor_s.php'>";

			echo "<div class='alert alert-danger' id='kosong'>
					Silahkan Cek seluruh Data Terlebih Dahulu.
					</div>";

			echo "<div class='table-responsive'>";

			echo "<table class='table table-bordered table-hover' width='100%'>
					<tr class='info'>
						<th colspan='8' class='text-center'>Preview Data</th>
					</tr>
					<tr class='info'>
						<th>Nama</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Nama Ortu</th>
						<th>NIS</th>
						<th>NISN</th>
						<th>No Pes</th>
						<th>Foto</th>
					</tr>";

			$numrow = 1;
			$kosong = 0;

			foreach ($sheet as $row) {
						$nama = $row['A'];
						$t_lahir = $row['B'];
						$tgl_lhr = $row['C'];
						$n_ortu = $row['D'];
						$nis = $row['E'];
						$nisn = $row['F'];
						$no_pes = $row['G'];
						$foto = $row['H'];

						if(empty($nama) &&  empty($t_lahir) &&  empty($tgl_lhr) &&  empty($n_ortu) &&  empty($nis) &&  empty($nisn) &&  empty($no_pes) &&  empty($foto)) continue;

						if($numrow > 1){
							$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
							$t_lahir_td = ( ! empty($t_lahir))? "" : " style='background: #E07171;'";
							$tgl_lhr_td = ( ! empty($tgl_lhr))? "" : " style='background: #E07171;'";
							$n_ortu_td = ( ! empty($n_ortu))? "" : " style='background: #E07171;'";
							$nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'";
							$nisn_td = ( ! empty($nisn))? "" : " style='background: #E07171;'";
							$no_pes_td = ( ! empty($no_pes))? "" : " style='background: #E07171;'";
							$foto_td = ( ! empty($foto))? "" : " style='background: #E07171;'";

							if(empty($nama) or empty($t_lahir) or empty($tgl_lhr) or empty($n_ortu) or empty($nis) or empty($nisn) or empty($no_pes) or empty($foto)){
								$kosong++;
							}

							echo "<tr class='warning'>";
							echo "<td" .$nama_td.">".$nama."</td>";
							echo "<td" .$t_lahir_td.">".$t_lahir."</td>";
							echo "<td" .$tgl_lhr_td.">".$tgl_lhr."</td>";
							echo "<td" .$n_ortu_td.">".$n_ortu."</td>";
							echo "<td" .$nis_td.">".$nis."</td>";
							echo "<td" .$nisn_td.">".$nisn."</td>";
							echo "<td" .$no_pes_td.">".$no_pes."</td>";
							echo "<td" .$foto_td.">".$foto."</td>";
							echo "</tr>";
						}

						$numrow++;
					}

			echo "</table>";

			echo "</div>";

					if($kosong > 1){
						?>

						<script>
						$(document).ready(function(){

							$("#jumlah_kosong").html('<?= $kosong; ?>');
							
							$("#nol").show();
						});
						</script>

						<?php
					}else{
						echo "<br>";

						echo "<input type=checkbox name='drop' value='1' /> <b> Kosongkan Data Siswa Terlebih Dahulu </b> ";

						echo "<br><br>";

						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-import'></span> Import</button>";
					}
			echo "</form>";		

		}else{
			echo "<br>";
			
			echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
				  </div>";
		}
	}

	?>
		
</fieldset>