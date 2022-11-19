<fieldset>
	<legend>Import Nilai USBN</legend>

	<script src="js/jquery.min.js"></script>
		
	<script>
	$(document).ready(function(){

		$("#nol").hide();
	});
	</script>


	<form action="" method="post" enctype="multipart/form-data">
		<a href="admin/impor/format_import_nilai_usbn_siswa.xlsx" class="btn btn-default pull-left">
			<span class="glyphicon glyphicon-download-alt"></span>
			Download Format
		</a><br><br><br>

		<input type="file" name="file" class="pull-left" required>

		<button type="submit" name="preview" class="btn btn-success btn-sm">
			<span class="glyphicon glyphicon-eye-open"></span> Preview
		</button> 

		<a href="?page=<?= base64_encode("nilai_us"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal </a>

	</form>

	<?php 

	if(isset($_POST['preview'])){
		$nama_file_baru = 'nilai_sekolah.xlsx';

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

			echo "<form method='post' action='admin/impor/impor_n_s.php'>";

			echo "<div class='alert alert-danger' id='kosong'>
					Silahkan Cek seluruh Data Terlebih Dahulu.
					</div>";

			echo "<div class='table-responsive'>";

			echo "<table class='table table-bordered table-hover' width='100%'>
					<tr class='info'>
						<th colspan='16' class='text-center'>Preview Data</th>
					</tr>
					<tr class='info'>
						<th>Nama</th>
						<th>No Peserta</th>
						<th>PAI</th>
						<th>PPKN</th>
						<th>IND</th>
						<th>MTK</th>
						<th>SEJIND</th>
						<th>ING</th>
						<th>SENBUD</th>
						<th>PJOK</th>
						<th>PKWU</th>
						<th>MAT/SEJ</th>
						<th>FIS/EKO</th>
						<th>KIM/SOS</th>
						<th>BIO/GEO</th>
						<th>LM</th>
					</tr>";

			$numrow = 1;
			$kosong = 0;

			foreach ($sheet as $row) {
						$nama = $row['A'];
						$no_pes = $row['B'];
						$pai = $row['C'];
						$ppkn = $row['D'];
						$ind = $row['E'];
						$mtk = $row['F'];
						$sejind = $row['G'];
						$ing = $row['H'];
						$senbud = $row['I'];
						$pjok = $row['J'];
						$pkwu = $row['K'];
						$mat_sej = $row['L'];
						$fis_eko = $row['M'];
						$kim_sos = $row['N'];
						$bio_geo = $row['O'];
						$lm = $row['P'];

						if(empty($nama) &&  empty($no_pes) &&  empty($pai) &&  empty($ppkn) &&  empty($ind) &&  empty($mtk) &&  empty($sejind) &&  empty($ing) &&  empty($senbud) &&  empty($pjok) &&  empty($pkwu) &&  empty($mat_sej) &&  empty($fis_eko) &&  empty($kim_sos) &&  empty($bio_geo) &&  empty($lm)) continue;

						if($numrow > 1){
							$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
							$no_pes_td = ( ! empty($no_pes))? "" : " style='background: #E07171;'";
							$pai_td = ( ! empty($pai))? "" : " style='background: #E07171;'";
							$ppkn_td = ( ! empty($ppkn))? "" : " style='background: #E07171;'";
							$ind_td = ( ! empty($ind))? "" : " style='background: #E07171;'";
							$mtk_td = ( ! empty($mtk))? "" : " style='background: #E07171;'";
							$sejind_td = ( ! empty($sejind))? "" : " style='background: #E07171;'";
							$ing_td = ( ! empty($ing))? "" : " style='background: #E07171;'";
							$senbud_td = ( ! empty($senbud))? "" : " style='background: #E07171;'";
							$pjok_td = ( ! empty($pjok))? "" : " style='background: #E07171;'";
							$pkwu_td = ( ! empty($pkwu))? "" : " style='background: #E07171;'";
							$mat_sej_td = ( ! empty($mat_sej))? "" : " style='background: #E07171;'";
							$fis_eko_td = ( ! empty($fis_eko))? "" : " style='background: #E07171;'";
							$kim_sos_td = ( ! empty($kim_sos))? "" : " style='background: #E07171;'";
							$bio_geo_td = ( ! empty($bio_geo))? "" : " style='background: #E07171;'";
							$lm_td = ( ! empty($lm))? "" : " style='background: #E07171;'";

							if(empty($nama) or empty($no_pes) or empty($pai) or empty($ppkn) or empty($ind) or empty($mtk) or empty($sejind) or empty($ing) or empty($senbud) or empty($pjok) or empty($pkwu) or empty($mat_sej) or empty($fis_eko) or empty($kim_sos) or empty($bio_geo) or empty($lm)){
								$kosong++;
							}

							echo "<tr class='warning'>";
							echo "<td" .$nama_td.">".$nama."</td>";
							echo "<td" .$no_pes_td.">".$no_pes."</td>";
							echo "<td" .$pai_td.">".$pai."</td>";
							echo "<td" .$ppkn_td.">".$ppkn."</td>";
							echo "<td" .$ind_td.">".$ind."</td>";
							echo "<td" .$mtk_td.">".$mtk."</td>";
							echo "<td" .$sejind_td.">".$sejind."</td>";
							echo "<td" .$ing_td.">".$ing."</td>";
							echo "<td" .$senbud_td.">".$senbud."</td>";
							echo "<td" .$pjok_td.">".$pjok."</td>";
							echo "<td" .$pkwu_td.">".$pkwu."</td>";
							echo "<td" .$mat_sej_td.">".$mat_sej."</td>";
							echo "<td" .$fis_eko_td.">".$fis_eko."</td>";
							echo "<td" .$kim_sos_td.">".$kim_sos."</td>";
							echo "<td" .$bio_geo_td.">".$bio_geo."</td>";
							echo "<td" .$lm_td.">".$lm."</td>";
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