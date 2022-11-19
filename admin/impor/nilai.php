<fieldset>
	<legend>Import Nilai Siswa</legend>

	<script src="js/jquery.min.js"></script>
		
	<script>
	$(document).ready(function(){

		$("#nol").hide();
	});
	</script>


	<form action="" method="post" enctype="multipart/form-data">
		<a href="admin/impor/format_import_nilai_siswa.xlsx" class="btn btn-default pull-left">
			<span class="glyphicon glyphicon-download-alt"></span>
			Download Format
		</a><br><br><br>

		<input type="file" name="file" class="pull-left" required>

		<button type="submit" name="preview" class="btn btn-success btn-sm">
			<span class="glyphicon glyphicon-eye-open"></span> Preview
		</button> 

		<a href="?page=<?= base64_encode("d_nilai"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal </a>

	</form>

	<?php 

	if(isset($_POST['preview'])){
		$nama_file_baru = 'nilai_siswa.xlsx';

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

			echo "<form method='post' action='admin/impor/impor_n.php'>";

			echo "<div class='alert alert-danger' id='kosong'>
					Silahkan Cek seluruh Data Terlebih Dahulu.
					</div>";

			echo "<div class='table-responsive'>";

			echo "<table class='table table-bordered table-hover' width='100%'>
					<tr class='info'>
						<th colspan='7' class='text-center'>Preview Data</th>
					</tr>
					<tr class='info'>
						<th>Nama</th>
						<th>No Peserta</th>
						<th>B. Indonesia</th>
						<th>B. Inggris</th>
						<th>Matematika</th>
						<th>Pilihan</th>
						<th>Keterangan</th>
					</tr>";

			$numrow = 1;
			$kosong = 0;

			foreach ($sheet as $row) {
						$nama = $row['A'];
						$no_pes = $row['B'];
						$bin = $row['C'];
						$bing = $row['D'];
						$mat = $row['E'];
						$pil = $row['F'];
						$ket = $row['G'];

						if(empty($nama) &&  empty($no_pes) &&  empty($bin) &&  empty($bing) &&  empty($mat) &&  empty($pil) &&  empty($ket)) continue;

						if($numrow > 1){
							$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
							$no_pes_td = ( ! empty($no_pes))? "" : " style='background: #E07171;'";
							$bin_td = ( ! empty($bin))? "" : " style='background: #E07171;'";
							$bing_td = ( ! empty($bing))? "" : " style='background: #E07171;'";
							$mat_td = ( ! empty($mat))? "" : " style='background: #E07171;'";
							$pil_td = ( ! empty($pil))? "" : " style='background: #E07171;'";
							$ket_td = ( ! empty($ket))? "" : " style='background: #E07171;'";

							if(empty($nama) or empty($no_pes) or empty($bin) or empty($bing) or empty($mat) or empty($pil) or empty($ket)){
								$kosong++;
							}

							echo "<tr class='warning'>";
							echo "<td" .$nama_td.">".$nama."</td>";
							echo "<td" .$no_pes_td.">".$no_pes."</td>";
							echo "<td" .$bin_td.">".$bin."</td>";
							echo "<td" .$bing_td.">".$bing."</td>";
							echo "<td" .$mat_td.">".$mat."</td>";
							echo "<td" .$pil_td.">".$pil."</td>";
							echo "<td" .$ket_td.">".$ket."</td>";
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

						echo "<input type=checkbox name='drop' value='1' /> <b> Kosongkan Data Nilai Terlebih Dahulu </b> ";

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